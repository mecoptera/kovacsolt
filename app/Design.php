<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Design extends Model implements HasMedia {
  use HasMediaTrait;

  protected $attributes = [ 'name' => '' ];
  protected $fillable = [ 'name' ];

  public function registerMediaConversions(Media $media = null) {
    $this->addMediaConversion('thumb')->keepOriginalImageFormat()->fit('max', 800, 800);
    $this->addMediaConversion('planner')->keepOriginalImageFormat()->fit('max', 1600, 1600);
  }
}
