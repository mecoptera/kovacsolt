<?php

use Illuminate\Database\Seeder;

class BaseProductsTableSeeder extends Seeder {
  public function run() {
    DB::table('base_products')->insert([
      'name' => 'Kerek nyakú unisex póló',
      'variants' => '["white", "blue"]'
    ]);
  }
}
