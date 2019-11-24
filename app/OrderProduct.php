<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model {
  protected $attributes = [];
  protected $fillable = [];
  protected $appends = [ 'product' ];

  public function getProductAttribute() {
    return Product::find($this->product_id);
  }
}
