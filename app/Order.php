<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
  protected $attributes = [];
  protected $fillable = [];
  protected $appends = [ 'status_label', 'product_price', 'shipping_price', 'total_price' ];

  public function getStatusLabelAttribute() {
    switch ($this->status) {
      case 'new': $statusLabel = 'Új'; break;
      case 'in_progress': $statusLabel = 'Folyamatban'; break;
      case 'closed': $statusLabel = 'Lezárt'; break;
    }

    return $statusLabel;
  }

  public function getProductPriceAttribute() {
    $orderProducts = OrderProduct::all()->where('order_id', $this->id);
    $productPrice = 0;

    foreach($orderProducts as $orderProduct) {
      $productPrice += $orderProduct->product->price * $orderProduct->quantity;
    }

    return $productPrice;
  }

  public function getShippingPriceAttribute() {
    return 1200;
  }

  public function getTotalPriceAttribute() {
    return $this->product_price + $this->shipping_price;
  }
}
