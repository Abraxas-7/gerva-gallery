<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\Event;
use App\Models\TrackSpot;
use Faker\Factory as Faker;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        if (Event::count() === 0) {
            $this->call(EventSeeder::class);
        }
        if (TrackSpot::count() === 0) {
            $this->call(TrackSpotSeeder::class);
        }

        $events = Event::all();
        $spots  = TrackSpot::all();

        foreach (range(1, 50) as $i) {
            Photo::create([
                'title'          => 'Foto #' . $i,
                'path'           => 'photos/photo_' . $i . '.jpg',
                'watermark_path' => 'photos/watermark/photo_' . $i . '.jpg',
                'event_id'       => $events->random()->id,
                'track_spot_id'  => $spots->isNotEmpty() ? $spots->random()->id : null,
                'taken_at'       => $faker->dateTimeBetween('-1 year', 'now'),
                'description'    => $faker->sentence(),
                'published'      => true,
            ]);
        }
    }
}
