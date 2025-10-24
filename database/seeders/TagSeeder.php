<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\TagCategory;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        // Recupera le categorie principali
        $marca = TagCategory::where('name', 'Marca')->first();
        $pilota = TagCategory::where('name', 'Pilota')->first();

        $tags = [
            // Marche moto
            ['tag_category_id' => $marca->id ?? null, 'name' => 'KTM'],
            ['tag_category_id' => $marca->id ?? null, 'name' => 'Yamaha'],
            ['tag_category_id' => $marca->id ?? null, 'name' => 'Honda'],
            ['tag_category_id' => $marca->id ?? null, 'name' => 'Kawasaki'],

            // Piloti
            ['tag_category_id' => $pilota->id ?? null, 'name' => 'Tony Cairoli'],
            ['tag_category_id' => $pilota->id ?? null, 'name' => 'Tim Gajser'],
            ['tag_category_id' => $pilota->id ?? null, 'name' => 'Jorge Prado'],

        ];

        foreach ($tags as $tag) {
            if ($tag['tag_category_id']) {
                Tag::updateOrCreate(['name' => $tag['name']], $tag);
            }
        }
    }
}
