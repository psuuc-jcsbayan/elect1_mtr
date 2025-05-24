<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory()->count(5)->create();
        $this->call(CategorySeeder::class);

        Category::create(['name' => 'General Discussion']);
        Thread::create(['title' => 'Welcome', 'body' => 'Hello Everyone!', 'user_id' => 1, 'category_id' => 1]);
    }
}