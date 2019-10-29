<?php

namespace Webacked\Cart;

use Webacked\Cart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller {
  public function index() {
    return view('cart::index', [
      'cart' => Cart::get(),
      'price' => number_format(Cart::price(), 0, ',', ' '),
      'shippingPrice' => number_format(Cart::shippingPrice(), 0, ',', ' '),
      'priceTotal' => number_format(Cart::priceTotal(), 0, ',', ' ')
    ]);
  }

  public function list() {
    return response()->json([
      'cart' => Cart::get(),
      'priceTotal' => number_format(Cart::priceTotal(), 0, ',', ' ')
    ]);
  }

  public function add($productId) {
    Cart::add($productId);
    return redirect()->back();
  }

  public function empty() {
    Cart::empty();
    return redirect()->back();
  }

  public function area($area) {
    return response()->json($this->{'area' . ucfirst($area)}(), 200);
  }

  private function areaCartButton() {
    return [ 'content' => view('cart::area', [
      'cart' => Cart::get(),
      'price' => number_format(Cart::price(), 0, ',', ' '),
      'shippingPrice' => number_format(Cart::shippingPrice(), 0, ',', ' '),
      'priceTotal' => number_format(Cart::priceTotal(), 0, ',', ' ')
    ])->render() ];
  }
}
