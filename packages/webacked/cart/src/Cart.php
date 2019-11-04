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
    $userCart = $this->userId ? CartModel::where([
      ['user_id', '=', $this->userId],
      ['closed', '=', false]
    ])->first() : null;

    $this->cartId = $userCart ? $userCart->id : null;

    if ($this->userId && !$userCart) {
      $this->cartId = $this->createDatabase();
    }

    if (Session::has('cart')) {
      $this->items = Session::get('cart');
    } elseif ($this->userId) {
      $cartProducts = CartProductModel::with('product')->where('cart_id', $this->cartId)->get();

      foreach ($cartProducts as $cartProduct) {
        $this->items[$cartProduct->product->id] = [
          'product' => $cartProduct->product,
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

  public function remove($productId) {
    unset($this->items[$productId]);

    $this->updateDatabase($productId);
    $this->updateSession();
  }

  public function empty() {
    $this->items = [];
    $this->emptyDatabase();
    $this->updateSession();
  }

  public function setQuantity($productId, $quantity) {
    $product = ProductModel::where('id', $productId)->first();

    if (!$product) { return 'error'; }

    if (intval($quantity) === 0) {
      $this->remove($productId);
    } else {
      $this->items[$productId] = [
        'product' => $product,
        'quantity' => $quantity
      ];

      $this->updateDatabase($productId);
      $this->updateSession();
    }
  }

  public function get() {
    return $this->items;
  }

  public function price() {
    $price = 0;

    foreach ($this->items as $item) {
      $price += ($item['product']->discount ? $item['product']->discountPrice : $item['product']->price) * $item['quantity'];
    }

    return $price;
  }

  private function createDatabase() {
    $cart = CartModel::create([ 'user_id' => $this->userId ]);

    return $cart->id;
  }

  private function updateDatabase($productId) {
    if (!$this->userId) { return; }

    if (isset($this->items[$productId])) {
      CartProductModel::updateOrCreate([
        'product_id' => $productId
      ],[
        'cart_id' => $this->cartId,
        'quantity' => $this->items[$productId]['quantity']
      ]);
    } else {
      CartProductModel::where('cart_id', $this->cartId)->where('product_id', $productId)->delete();
    }
  }

  private function emptyDatabase() {
    CartModel::where('id', $this->cartId)->update([ 'closed' => true ]);
  }

  private function updateSession() {
    Session::put('cart', $this->items);
  }
}
