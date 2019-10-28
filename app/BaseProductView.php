<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class BaseProductView extends Model implements HasMedia {
  use HasMediaTrait;

  protected $attributes = [ 'name' => '' ];
  protected $fillable = [ 'name' ];
}