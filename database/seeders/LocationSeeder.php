<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use Faker\Factory as Faker;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $i) {
            Location::create([
                'name' => 'Circuito ' . $faker->city(),
                'city' => $faker->city(),
                'latitude' => $faker->latitude(),
                'longitude' => $faker->longitude(),
                'description' => $faker->sentence(),
            ]);
        }
    }
}
