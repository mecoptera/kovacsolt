<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseProduct extends Model {
  protected $attributes = [ 'name' => '' ];
  protected $fillable = [ 'name' ];
  protected $appends = [ 'base_product_view_default' ];

  public function getBaseProductViewDefaultAttribute() {
    $baseProductView = BaseProductView::where('base_product_id', $this->id)->where('default', 1)->first();
    return $baseProductView ? $baseProductView->toArray() : null;
  }
}
