<?php

use Faker\Factory as Faker;

class UploadsTableSeeder extends Seeder {
    
    public function run() {
        
        $faker = Faker::create();
        
        foreach(range(1, 10) as $user) {
            Upload::create([
                'user_id' => $faker->numberBetween(1, 10),
                'filename' => 'Hangouts.json',
                'filesize' => $faker->randomFloat(),
                'synced' => 1,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}