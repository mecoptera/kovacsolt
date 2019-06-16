<?php

namespace Webacked\Cart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider {
  public function register() {
    $this->app->bind('cart', 'Webacked\Cart\Cart');

    //$config = __DIR__ . '/config/cart.php';
    //$this->mergeConfigFrom($config, 'cart');

    $this->publishes([__DIR__ . '/config/cart.php' => config_path('cart.php')], 'config');
  }

  public function boot() {

  }
}
