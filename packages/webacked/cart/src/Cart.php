<?php

namespace Webacked\Cart;

use Auth;
use Session;
use Illuminate\Support\Facades\DB;
use App\Product as ProductModel;
use Webacked\Cart\Models\Cart as CartModel;
use Webacked\Cart\Models\CartProduct as CartProductModel;

class Cart {
  private $items = [];
  private $userId = false;
  private $cartId = null;

  public function __construct() {
    $this->userId = Auth::user() ? Auth::user()->id : false;
    $userCart = $this->userId ? CartModel::where([
      [ 'user_id', '=', $this->userId ],
      [ 'closed', '=', false ]
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
        $this->items[$cartProduct->unique_id] = [
          'uniqueId' => $cartProduct->unique_id,
          'product' => $cartProduct->product,
          'extraData' => json_decode($cartProduct->extra_data, true),
          'quantity' => $cartProduct->quantity
        ];
      }

      $this->updateSession();
    }
  }

  public function init() {
    if (Session::has('cart') && $this->userId) {
      CartProductModel::where('cart_id', $this->cartId)->delete();
      $this->fillDatabase();
    }
  }

  public function add($productId, $extraData) {
    $product = ProductModel::where('id', $productId)->first();

    if (!$product) { return 'error'; }

    $uniqueId = md5(uniqid());

    $this->items[] = [
      'uniqueId' => $uniqueId,
      'product' => $product,
      'extraData' => $extraData,
      'quantity' => 1
    ];

    $this->updateDatabase($uniqueId);
    $this->updateSession();
  }

  public function remove($uniqueId) {
    $key = array_search($uniqueId, array_column($this->items, 'uniqueId'));
    unset($this->items[$key]);

    $this->updateDatabase($uniqueId);
    $this->updateSession();
  }

  public function empty() {
    $this->items = [];
    $this->emptyDatabase();
    $this->updateSession();
  }

  public function setQuantity($uniqueId, $quantity) {
    $key = array_search($uniqueId, array_column($this->items, 'uniqueId'));

    if ($key === false) { return 'error'; }

    if (intval($quantity) === 0) {
      $this->remove($uniqueId);
    } else {
      $this->items[$key]['quantity'] = $quantity;

      $this->updateDatabase($uniqueId);
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

  private function fillDatabase() {
    if (!$this->userId || count($this->items) === 0) { return; }

    foreach ($this->items as $item) {
      $items[] = [
        'unique_id' => $item['uniqueId'],
        'product_id' => $item['product']->id,
        'cart_id' => $this->cartId,
        'extra_data' => json_encode($item['extraData']),
        'quantity' => $item['quantity'],
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now()
      ];
    }

    DB::table('cart_products')->insert($items);
  }

  private function updateDatabase($uniqueId) {
    if (!$this->userId) { return; }

    $key = array_search($uniqueId, array_column($this->items, 'uniqueId'));

    if (isset($this->items[$key])) {
      CartProductModel::updateOrCreate([
        'unique_id' => $uniqueId
      ],[
        'product_id' => $this->items[$key]['product']->id,
        'cart_id' => $this->cartId,
        'extra_data' => json_encode($this->items[$key]['extra_data']),
        'quantity' => $this->items[$key]['quantity']
      ]);
    } else {
      CartProductModel::where('cart_id', $this->cartId)->where('unique_id', $uniqueId)->delete();
    }
  }

  private function emptyDatabase() {
    CartModel::where('id', $this->cartId)->update([ 'closed' => true ]);
  }

  private function updateSession() {
    Session::put('cart', $this->items);
  }
}
