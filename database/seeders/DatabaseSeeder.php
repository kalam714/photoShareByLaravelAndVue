<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Category::create(['name'=>'Humans']);
        Category::create(['name'=>'Animals']);
        Category::create(['name'=>'Tech']);
        Category::create(['name'=>'Nature']);
        Category::create(['name'=>'UnderWater']);
        Category::create(['name'=>'NightMood']);
        Category::create(['name'=>'Wildlife']);
        Category::create(['name'=>'Creative']);

    }
}
