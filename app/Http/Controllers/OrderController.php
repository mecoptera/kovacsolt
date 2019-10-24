<?php

namespace App\Http\Controllers;

use Auth;
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

    if ($request->input('shipping_method') === '2') {
      $shippingMethodText = 'Házhozszállítás';

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
    return view('page.order.finalize', [
      'step' => 4,
      'billingData' => session()->get('billingData'),
      'shippingData' => session()->get('shippingData'),
      'paymentData' => session()->get('paymentData'),
      'finalizeData' => session()->get('finalizeData'),
      'cart' => Cart::get(),
      'shippingPrice' => number_format(1200, 0, ',', ' '),
      'priceTotal' => number_format(Cart::priceTotal() + 1200, 0, ',', ' ')
    ]);
  }

  public function finalizePost(Request $request) {
    $request->session()->put('finalizeData', $request->all());

    if ($request->session()->get('paymentData')['payment_method'] === '2') {
      $url = SimplePay::test();
      return redirect()->to($url);
    }

    return view('page.order.success');
  }


  public function success() {
    return view('page.order.success');
  }

  public function error() {
    return view('page.order.error');
  }
}
