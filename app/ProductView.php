<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductView extends Model {
  protected $appends = [ 'design', 'product_image', 'base_product_view' ];

  public function getDesignAttribute() {
    return url(Design::where('id', $this->design_id)->first()->getFirstMediaUrl('design', 'thumb'));
  }

  public function getProductImageAttribute() {
    return url(BaseProductView::where('id', $this->base_product_view_id)->first()->getFirstMediaUrl('product'));
  }

  public function getBaseProductViewAttribute() {
    return BaseProductView::where('id', $this->base_product_view_id)->first()->toArray();
  }
}
