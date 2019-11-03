<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Webacked\Cart\Facades\Cart;
use Webacked\SimplePay\Facades\SimplePay;

class OrderController extends Controller {
  public function profile() {
    if (Auth::guard('web')->check()) {
      return redirect(route('order.billing'));
    }

    return view('page.order.profile', [ 'step' => 0 ]);
  }

  public function billing(Request $request) {
    return view('page.order.billing', [ 'step' => 1, 'billingData' => session()->get('billingData') ]);
  }

  public function billingPost(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'zip' => 'required|digits:4',
      'city' => 'required',
      'address' => 'required',
      'email' => 'required|email',
    ], [
      'name.required' => 'Kötelező kitölteni',
      'zip.required' => 'Kötelező kitölteni',
      'zip.digits' => 'Maximum 4 számjegy',
      'city.required' => 'Kötelező kitölteni',
      'address.required' => 'Kötelező kitölteni',
      'email.required' => 'Kötelező kitölteni',
      'email.email' => 'Nem megfelelő formátum'
    ]);

    $request->session()->put('billingData', $request->all());

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    }

    return redirect(route('order.shipping'));
  }

  public function shipping() {
    return view('page.order.shipping', [ 'step' => 2, 'shippingData' => session()->get('shippingData') ]);
  }

  public function shippingPost(Request $request) {
    $validationRules = [];
    $validationMessages = [];

    switch ($request->input('shipping_method')) {
      case 0: $shippingMethodText = 'Személyes átvétel (Ingyenes)'; break;
      case 1: $shippingMethodText = 'Postai átvétel (800 Ft)'; break;
      case 2: $shippingMethodText = 'Házhozszállítás (1 200 Ft)'; break;
      case 3: $shippingMethodText = 'Átvétel csomagponton (800 Ft)'; break;
    }

    if ($request->input('shipping_method') === '2') {
      $validationRules = [
        'name' => 'required',
        'zip' => 'required|digits:4',
        'city' => 'required',
        'address' => 'required',
        'email' => 'required|email',
      ];

      $validationMessages = [
        'name.required' => 'Kötelező kitölteni',
        'zip.required' => 'Kötelező kitölteni',
        'zip.digits' => 'Maximum 4 számjegy',
        'city.required' => 'Kötelező kitölteni',
        'address.required' => 'Kötelező kitölteni',
        'email.required' => 'Kötelező kitölteni',
        'email.email' => 'Nem megfelelő formátum'
      ];
    }

    $validator = Validator::make($request->all(), $validationRules, $validationMessages);

    $request->session()->put('shippingData', $request->all());
    $request->session()->put('shippingData.shipping_method_text', $shippingMethodText);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    }

    return redirect(route('order.payment'));
  }

  public function payment() {
    return view('page.order.payment', [ 'step' => 3, 'paymentData' => session()->get('paymentData') ]);
  }

  public function paymentPost(Request $request) {
    switch ($request->input('payment_method')) {
      case 0: $paymentMethodText = 'Személyesen, készpénzzel'; break;
      case 1: $paymentMethodText = 'Utánvétellel futárnak'; break;
      case 2: $paymentMethodText = 'Bankkártyás fizetés'; break;
    }

    $request->session()->put('paymentData', $request->all());
    $request->session()->put('paymentData.payment_method_text', $paymentMethodText);

    return redirect(route('order.finalize'));
  }

  public function finalize() {
    switch (session()->get('shippingData')['shipping_method']) {
      case 0: $shippingPrice = 0; break;
      case 1: $shippingPrice = 800; break;
      case 2: $shippingPrice = 1200; break;
      case 3: $shippingPrice = 800; break;
    }

    return view('page.order.finalize', [
      'step' => 4,
      'billingData' => session()->get('billingData'),
      'shippingData' => session()->get('shippingData'),
      'paymentData' => session()->get('paymentData'),
      'finalizeData' => session()->get('finalizeData'),
      'cart' => Cart::get(),
      'price' => Cart::price(),
      'shippingPrice' => $shippingPrice,
      'priceTotal' => Cart::price() + $shippingPrice
    ]);
  }

  public function finalizePost(Request $request) {
    $request->session()->put('finalizeData', $request->all());

    $order = new Order;
    $order->order_id = uniqid();
    $order->user_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : null;
    $order->user_name = session()->get('billingData')['name'];
    $order->user_billing_address = session()->get('billingData')['zip'] . ' ' .
      session()->get('billingData')['city'] . ', ' .
      session()->get('billingData')['address'];
    $order->user_shipping_address = session()->get('shippingData')['zip'] . ' ' .
      session()->get('shippingData')['city'] . ', ' .
      session()->get('shippingData')['address'];
    $order->user_email = session()->get('billingData')['email'];
    $order->user_phone = session()->get('billingData')['phone'];
    $order->shipping_mode = session()->get('shippingData')['shipping_method'];
    $order->payment_mode = session()->get('paymentData')['payment_method'];
    $order->payment_reference = null;
    $order->payment_status = 'in_progress';
    $order->status = 'new';
    $order->save();

    $cartItems = Cart::get();

    foreach($cartItems as $item) {
      $orderProduct = new OrderProduct;
      $orderProduct->order_id = $order->id;
      $orderProduct->product_id = $item['product']->id;
      $orderProduct->quantity = $item['quantity'];
      $orderProduct->status = 'in_progress';
      $orderProduct->save();
    }

    Cart::empty();

    session()->put('orderId', $order->order_id);

    if ($request->session()->get('paymentData')['payment_method'] === '2') {
      $url = SimplePay::test($order->order_id);
      return redirect()->to($url);
    }

    return redirect(route('order.success'));
  }


  public function success() {
    return view('page.order.success', [ 'orderId' => session()->get('orderId') ]);
  }

  public function error() {
    return view('page.order.error');
  }
}
