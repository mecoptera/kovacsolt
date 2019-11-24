<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseProduct extends Model {
  protected $attributes = [ 'name' => '' ];
  protected $fillable = [ 'name' ];
  protected $appends = [ 'base_product_variant_default' ];

  public function getBaseProductVariantDefaultAttribute() {
    return BaseProductVariant::where('base_product_id', $this->id)->first();
  }
}
