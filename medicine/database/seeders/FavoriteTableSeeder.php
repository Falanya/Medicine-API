<?php

namespace Database\Seeders;

use App\Models\Favorites;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Favorites::factory()->count(1000)->create();
    }
}
