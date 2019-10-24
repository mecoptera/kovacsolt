<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseProduct extends Model {
  protected $attributes = [ 'name' => '' ];
  protected $fillable = [ 'name' ];
}
