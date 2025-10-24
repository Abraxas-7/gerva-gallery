<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Location;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        if (Location::count() === 0) {
            $this->call(LocationSeeder::class);
        }

        $locations = Location::all();

        foreach (range(1, 8) as $i) {
            Event::create([
                'name' => 'Evento ' . $faker->word(),
                'date' => $faker->dateTimeBetween('-6 months', '+3 months'),
                'location_id' => $locations->random()->id,
                'description' => $faker->sentence(10),
            ]);
        }
    }
}
