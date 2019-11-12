<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class BaseProductView extends Model implements HasMedia {
  use HasMediaTrait;

  protected $appends = [ 'base_product_color', 'base_product_view_image' ];

  public function registerMediaConversions(Media $media = null) {
    $this->addMediaConversion('thumb')->keepOriginalImageFormat()->fit('max', 800, 800);
    $this->addMediaConversion('planner')->keepOriginalImageFormat()->fit('max', 1600, 1600);
  }

  public function getBaseProductColorAttribute() {
    return BaseProductColor::find($this->base_product_color_id);
  }
}
