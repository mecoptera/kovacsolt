<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupBaseProduct extends Model {
  protected $appends = [ 'group', 'base_product' ];

  public function getGroupAttribute() {
    return Group::where('id', $this->group_id)->get();
  }

  public function getBaseProductAttribute() {
    return BaseProduct::where('id', $this->base_product_id)->get();
  }
}
