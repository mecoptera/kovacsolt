<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder {
  public function run() {
    $faker = Faker\Factory::create();

    $limit = 10;

    for ($i = 0; $i < $limit; $i++) {
      DB::table('admins')->insert([
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make(123456)
      ]);
    }
  }
}
