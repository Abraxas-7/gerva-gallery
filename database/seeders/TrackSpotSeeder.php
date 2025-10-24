<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrackSpot;
use App\Models\Location;
use Faker\Factory as Faker;

class TrackSpotSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        if (Location::count() === 0) {
            $this->call(\Database\Seeders\LocationSeeder::class);
        }

        $locations = Location::all();

        foreach (range(1, 6) as $i) {
            TrackSpot::create([
                'location_id' => $locations->random()->id,
                'name' => 'Spot ' . $faker->word(),
                'description' => $faker->sentence(),
            ]);
        }
    }
}
