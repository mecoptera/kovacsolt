<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model {
  protected $appends = [
    'base_product_variant',
    'design_name',
    'design_image'
  ];

  public function getBaseProductVariantAttribute() {
    return BaseProductVariant::find($this->base_product_variant_id);
  }

  public function getDesignNameAttribute() {
    return Design::find($this->design_id)->name;
  }

  public function getDesignImageAttribute() {
    $media = Design::find($this->design_id)->getFirstMedia('design');

    return [
      'original' => $media->getUrl(),
      'thumb' => $media->getUrl('thumb'),
      'planner' => $media->getUrl('planner')
    ];
  }
}
