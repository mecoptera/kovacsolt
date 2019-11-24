<?php

namespace App\Http\Controllers\Panel;

use App\Order;
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

  public function edit($id = false) {

  }

  public function update($id = false, Request $request) {

  }

  public function remove($id) {

  }
}
