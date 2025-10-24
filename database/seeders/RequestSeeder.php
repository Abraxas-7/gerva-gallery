<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request as PhotoRequest; // alias per evitare conflitti col namespace Illuminate\Http\Request
use App\Models\Client;
use App\Models\Photo;
use Faker\Factory as Faker;

class RequestSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        if (Client::count() === 0) {
            $this->call(ClientSeeder::class);
        }
        if (Photo::count() === 0) {
            $this->call(PhotoSeeder::class);
        }

        $clients = Client::all();
        $photos  = Photo::all();

        foreach ($clients as $client) {
            foreach (range(1, rand(1, 3)) as $i) {
                $req = PhotoRequest::create([
                    'client_id' => $client->id,
                    'status'    => $faker->randomElement(['pending', 'paid', 'completed']),
                    'notes'     => $faker->optional()->sentence(),
                ]);

                // 2–5 foto per richiesta
                $req->photos()->attach(
                    $photos->random(rand(2, 5))->pluck('id')->toArray()
                );
            }
        }
    }
}
