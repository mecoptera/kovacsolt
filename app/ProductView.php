<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductView extends Model {
  protected $appends = [
    'base_product_view',
    'design_image'
  ];

  public function getBaseProductViewAttribute() {
    return BaseProductView::find($this->base_product_view_id);
  }

  public function getDesignImageAttribute() {
    $media = Design::find($this->design_id)->getFirstMedia('design');

    return [
      'thumb' => $media->getUrl('thumb'),
      'planner' => $media->getUrl('planner')
    ];
  }
}
