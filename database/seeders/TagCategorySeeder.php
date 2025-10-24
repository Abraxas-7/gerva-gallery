<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TagCategory;

class TagCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Marca', 'description' => 'Marca della moto (es. KTM, Honda, Yamaha...)'],
            ['name' => 'Pilota', 'description' => 'Nome del pilota nelle foto o negli eventi'],
        ];

        foreach ($categories as $category) {
            TagCategory::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
