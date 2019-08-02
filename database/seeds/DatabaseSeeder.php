<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
  public function run() {
    $this->call(UsersTableSeeder::class);
    $this->call(AdminsTableSeeder::class);
    $this->call(BaseProductsTableSeeder::class);
  }
}
