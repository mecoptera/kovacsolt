<?php

namespace Webacked\Cart;

use Session;
use Webacked\Cart\Facades\Cart;

class Helpers {
  public static function itemsCount() {
    $cart = Cart::get();
    $count = 0;

    if ($cart) {
      foreach ($cart as $item) {
        $count += $item['quantity'];
      }
    }

    return $count;
  }
}
