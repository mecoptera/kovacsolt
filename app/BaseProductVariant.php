<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class BaseProductVariant extends Model implements HasMedia {
  use HasMediaTrait;

  protected $appends = [ 'base_product_color', 'base_product_view', 'base_product_zone', 'image' ];

  public function registerMediaConversions(Media $media = null) {
    $this->addMediaConversion('thumb')->keepOriginalImageFormat()->fit('max', 800, 800)->nonOptimized();
    $this->addMediaConversion('planner')->keepOriginalImageFormat()->fit('max', 1600, 1600)->nonOptimized();
  }

  public function registerMediaCollections() {
    $this->addMediaCollection('base_product_variant')->singleFile();
  }

  public function getBaseProductColorAttribute() {
    return BaseProductColor::find($this->base_product_color_id);
  }

  public function getBaseProductViewAttribute() {
    return BaseProductView::find($this->base_product_view_id);
  }

  public function getBaseProductZoneAttribute() {
    return BaseProductZone::find($this->base_product_zone_id);
  }

  public function getImageAttribute() {
    $media = $this->getFirstMedia('base_product_variant');

    return [
      'thumb' => $media->getUrl('thumb'),
      'planner' => $media->getUrl('planner')
    ];
  }
}
