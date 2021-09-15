<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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

        User::truncate();
        Category::truncate();
         //\App\Models\User::factory(10)->create();
         //\App\Models\User::factory()->create();

         User::factory()->create();

         Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
         ]);

         Category::create([
            'name' => 'Work',
            'slug' => 'worh',
         ]);
         Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies',
         ]);

        }
}
