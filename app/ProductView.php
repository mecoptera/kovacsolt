<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductView extends Model {
  protected $appends = [
    'base_product_view',
    'base_product_view_image',
    'design_image'
  ];

  public function getBaseProductViewAttribute() {
    return BaseProductView::find($this->base_product_view_id);
  }

  public function getBaseProductViewImageAttribute() {
    $media = $this->getBaseProductViewAttribute()->getFirstMedia('base_product_view');

    return [
      'thumb' => $media->getUrl('thumb'),
      'planner' => $media->getUrl('planner')
    ];
  }

  public function getDesignImageAttribute() {
    $media = Design::find($this->design_id)->getFirstMedia('design');

    return [
      'thumb' => $media->getUrl('thumb'),
      'planner' => $media->getUrl('planner')
    ];
  }
}
