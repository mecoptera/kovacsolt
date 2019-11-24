<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model {
  protected $appends = [
    'base_product_variant',
    'design_image'
  ];

  public function getBaseProductVariantAttribute() {
    return BaseProductVariant::find($this->base_product_variant_id);
  }

  public function getDesignImageAttribute() {
    $media = Design::find($this->design_id)->getFirstMedia('design');

    return [
      'thumb' => $media->getUrl('thumb'),
      'planner' => $media->getUrl('planner')
    ];
  }
}
