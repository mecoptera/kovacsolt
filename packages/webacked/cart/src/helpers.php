<?php

namespace Webacked\Cart;

use Session;

class Helpers {
  public static function itemsCount() {
    $count = 0;

    if (Session::has('cart')) {
      foreach (Session::get('cart') as $item) {
        $count += $item['quantity'];
      }
    }

    return $count;
  }
}
