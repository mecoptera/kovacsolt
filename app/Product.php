<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  protected $appends = [ 'base_product_name', 'product_variants', 'product_variant_default', 'discount_price' ];

  public function getBaseProductNameAttribute() {
    return BaseProduct::find($this->base_product_id)->name;
  }

  public function getProductVariantsAttribute() {
    return ProductVariant::where('product_id', $this->id)->get();
  }

  public function getProductVariantDefaultAttribute() {
    return ProductVariant::where('product_id', $this->id)->first();
  }

  public function getDiscountPriceAttribute() {
    return $this->discount ? $this->ceiling($this->price * ((100 - $this->discount) / 100), 10) : false;
  }

  private function ceiling($number, $significance = 1) {
    return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
  }
}
