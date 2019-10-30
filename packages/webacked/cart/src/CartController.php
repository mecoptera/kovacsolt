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
      'price' => Cart::price()
    ]);
  }

  public function finalize(Request $request) {
    foreach($request->get('quantity') as $productId => $quantity) {
      Cart::setQuantity($productId, $quantity);
    }

    return redirect()->route('order.profile');
  }

  // public function list() {
  //   return response()->json([
  //     'cart' => Cart::get(),
  //     'priceTotal' => number_format(Cart::priceTotal(), 0, ',', ' ')
  //   ]);
  // }

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
    return [ 'content' => view('cart::area-cart-button', [ 'cart' => Cart::get() ])->render() ];
  }
}
