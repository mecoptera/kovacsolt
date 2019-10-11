<?php

namespace Webacked\SimplePay;

use Illuminate\Support\ServiceProvider;

class SimplePayServiceProvider extends ServiceProvider {
  public function register() {
    $this->app->bind('simplePay', 'Webacked\SimplePay\SimplePay');
  }

  public function boot() {
    $this->mergeConfigFrom(__DIR__ . '/config/simple-pay.php', 'simplePay');

    $this->publishes([__DIR__ . '/config/simple-pay.php' => config_path('simple-pay.php')], 'config');
  }
}
