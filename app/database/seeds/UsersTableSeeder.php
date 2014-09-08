<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {
    
    public function run() {
        
        $faker = Faker::create();
        
        foreach(range(1, 10) as $user) {
            User::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}