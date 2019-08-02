<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  protected $hidden = [ 'design_id' ];
  protected $appends = [ 'design', 'discount_price' ];

  public function getDesignAttribute() {
    return url(Design::where('id', $this->design_id)->first()->getFirstMediaUrl('design'));
  }

  public function getDiscountPriceAttribute() {
    return number_format($this->ceiling($this->price * 0.75, 10), 0, ',', ' ');
  }

  public function price() {
    return number_format($this->price, 0, ',', ' ');
  }

  private function ceiling($number, $significance = 1) {
    return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
  }
}
