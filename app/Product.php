<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  protected $appends = [ 'product_views', 'product_view_default', 'price_formatted', 'discount_price', 'discount_price_formatted' ];

  public function getProductViewsAttribute() {
    return ProductView::where('product_id', $this->id)->get()->toArray();
  }

  public function getProductViewDefaultAttribute() {
    $productView = ProductView::where('product_id', $this->id)->where('default', 1)->first();
    return $productView ? $productView->toArray() : null;
  }

  public function getPriceFormattedAttribute() {
    return number_format($this->price, 0, ',', ' ');
  }

  public function getDiscountPriceAttribute() {
    return $this->discount ? $this->ceiling($this->price * ((100 - $this->discount) / 100), 10) : false;
  }

  public function getDiscountPriceFormattedAttribute() {
    return $this->discount ? number_format($this->ceiling($this->price * ((100 - $this->discount) / 100), 10), 0, ',', ' ') : false;
  }

  private function ceiling($number, $significance = 1) {
    return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
  }
}
