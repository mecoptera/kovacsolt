<?php

namespace Webacked\Cart;

use Webacked\Cart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller {
  public function index() {
    return view('cart::index', [ 'cart' => Cart::get(), 'priceTotal' => Cart::priceTotal() ]);
  }

  public function list() {
    return response()->json([ 'cart' => Cart::get(), 'priceTotal' => Cart::priceTotal() ]);
  }

  public function add(Request $request) {
    Cart::add($request->product_id);
    return redirect()->back();
  }

  public function empty() {
    Cart::empty();
    return redirect()->back();
  }
}
