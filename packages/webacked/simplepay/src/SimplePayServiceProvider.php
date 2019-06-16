<?php

namespace Webacked\SimplePay;

use Illuminate\Support\ServiceProvider;

class SimplePayServiceProvider extends ServiceProvider {
  public function register() {
    $this->app->make('Webacked\SimplePay\SimplePayController');
    $this->loadViewsFrom(__DIR__.'/views', 'simplepay');
  }

  public function boot() {
    include __DIR__.'/routes.php';
  }
}
