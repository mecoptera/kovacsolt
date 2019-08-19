<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  protected $hidden = [ 'design_id' ];
  protected $appends = [ 'design', 'price_formatted', 'discount_price', 'discount_price_formatted' ];

  public function getDesignAttribute() {
    return url(Design::where('id', $this->design_id)->first()->getFirstMediaUrl('design'));
  }

  public function getPriceFormattedAttribute() {
    return number_format($this->price, 0, ',', ' ');
  }

  public function getDiscountPriceAttribute() {
    return $this->ceiling($this->price * 0.75, 10);
  }

  public function getDiscountPriceFormattedAttribute() {
    return number_format($this->ceiling($this->price * 0.75, 10), 0, ',', ' ');
  }

  private function ceiling($number, $significance = 1) {
    return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
  }
}
