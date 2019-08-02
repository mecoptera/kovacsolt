<?php

namespace Webacked\Cart;

use Auth;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Contracts\Events\Dispatcher;
use Session;
use App\Product as ProductModel;
use Webacked\Cart\Models\Cart as CartModel;
use Webacked\Cart\Models\CartProduct as CartProductModel;

class Cart {
  private $items = [];
  private $userId = null;
  private $cartId = null;

  public function __construct() {
    $this->userId = Auth::user() ? Auth::user()->id : false;
    $this->cartId = $this->userId ? CartModel::where('user_id', $this->userId)->first()->id : null;

    if (Session::has('cart')) {
      $this->items = Session::get('cart');
    } elseif ($this->userId) {
      $cartProducts = CartProductModel::with('product')->where('cart_id', $this->cartId)->get();

      foreach ($cartProducts as $cartProduct) {
        $this->items[$cartProduct->product->id] = [
          'product' => $cartProduct->product->first(),
          'quantity' => $cartProduct->quantity
        ];
      }

      $this->updateSession();
    }
  }

  public function add($productId) {
    $product = ProductModel::where('id', $productId)->first();

    if (!$product) { return 'error'; }

    $this->items[$productId] = [
      'product' => $product,
      'quantity' => array_key_exists($productId, $this->items) ? $this->items[$productId]['quantity'] + 1 : 1
    ];

    $this->updateDatabase($productId);
    $this->updateSession();
  }

  public function get() {
    return $this->items;
  }

  public function priceTotal() {
    $priceTotal = 0;

    foreach ($this->items as $item) {
      $priceTotal += $item['product']['price'] * $item['quantity'];
    }

    return $priceTotal;
  }

  public function empty() {
    $this->items = [];
    $this->updateSession();
  }

  private function updateDatabase($productId) {
    if (!$this->userId) { return; }

    CartProductModel::updateOrCreate([
      'product_id' => $productId,
    ],[
      'cart_id' => $this->cartId,
      'product_id' => $productId,
      'quantity' => \DB::raw('quantity + 1')
    ]);
  }

  private function updateSession() {
    Session::put('cart', $this->items);
  }
}
