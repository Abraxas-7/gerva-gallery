<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            Client::create([
                'name'  => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'notes' => $faker->optional()->sentence(),
            ]);
        }
    }
}
