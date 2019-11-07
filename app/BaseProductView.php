<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class BaseProductView extends Model implements HasMedia {
  use HasMediaTrait;

  protected $attributes = [ 'name' => '' ];
  protected $fillable = [ 'name' ];
  protected $appends = [ 'base_product_name', 'base_product_image' ];

  public function getBaseProductNameAttribute() {
    return BaseProduct::where('id', $this->base_product_id)->first()->name;
  }

  public function getBaseProductImageAttribute() {
    return url(BaseProductView::where('id', $this->id)->first()->getFirstMediaUrl('product'));
  }
}
