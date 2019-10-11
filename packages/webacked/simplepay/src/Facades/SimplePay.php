<?php

namespace Webacked\SimplePay\Facades;

use Illuminate\Support\Facades\Facade;

class SimplePay extends Facade {
  protected static function getFacadeAccessor() {
    return 'simplePay';
  }
}
