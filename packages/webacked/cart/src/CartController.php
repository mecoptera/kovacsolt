<?php

namespace Webacked\Cart;

use Webacked\Cart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller {
  public function index() {
    return view('cart::index', [
      'cart' => Cart::get(),
      'price' => Cart::price()
    ]);
  }

  public function finalize(Request $request) {
    foreach($request->get('quantity') as $uniqueId => $quantity) {
      Cart::setQuantity($uniqueId, $quantity);
    }

    return redirect()->route('order.profile');
  }

  public function add($productId, Request $request) {
    Cart::add($productId, $request->get('extra_data'));

    return redirect(route('cart'));
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
