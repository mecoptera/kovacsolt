<?php

namespace App\Http\Controllers\Panel;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller {
  public function __construct() {
    $this->middleware('auth:admin');
  }

  public function index() {
    $orders = Order::all();

    return view('panel.orders', [ 'orders' => $orders ]);
  }

  public function edit($id) {
    $order = Order::find($id);
    $orderProducts = OrderProduct::all()->where('order_id', $id);

    return view('panel.order-edit', [
      'order' => $order,
      'billingData' => json_decode($order->billing_data, true),
      'shippingData' => json_decode($order->shipping_data, true),
      'paymentData' => json_decode($order->payment_data, true),
      'finalizeData' => json_decode($order->finalize_data, true),
      'orderProducts' => $orderProducts
    ]);
  }

  public function update($id, Request $request) {

  }

  public function remove($id) {

  }
}
