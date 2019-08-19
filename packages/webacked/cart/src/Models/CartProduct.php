<?php

namespace Webacked\Cart\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model {
  protected $fillable = [ 'cart_id', 'product_id', 'quantity' ];
  protected $with = array('product');

  public function product() {
    return $this->hasOne(\App\Product::class, 'id', 'product_id');
  }
}
