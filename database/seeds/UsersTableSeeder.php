<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
  public function run() {
    $faker = Faker\Factory::create();

    $limit = 10;

    for ($i = 0; $i < $limit; $i++) {
      DB::table('users')->insert([
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => date('Y-m-d H:i:s'),
        'password' => Hash::make(123456)
      ]);
    }
  }
}
