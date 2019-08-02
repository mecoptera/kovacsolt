<?php

namespace Webacked\Cart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider {
  public function register() {
    $this->app->bind('cart', 'Webacked\Cart\Cart');
  }

  public function boot() {
    $this->mergeConfigFrom(__DIR__ . '/config/cart.php', 'cart');

    $this->loadViewsFrom(__DIR__.'/views', 'cart');
    $this->loadMigrationsFrom(__DIR__.'/database/migrations');

    $this->publishes([__DIR__ . '/config/cart.php' => config_path('cart.php')], 'config');

    include __DIR__.'/routes.php';
    include __DIR__.'/helpers.php';
  }
}
