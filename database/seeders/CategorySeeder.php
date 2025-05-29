<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'IT Sector'],
            ['id' => 2, 'name' => 'Food'],
            ['id' => 3, 'name' => 'Fashion'],
            ['id' => 4, 'name' => 'Sports'],
            ['id' => 5, 'name' => 'Health'],
            ['id' => 6, 'name' => 'Travel'],
            ['id' => 7, 'name' => 'Education'],
            ['id' => 8, 'name' => 'Entertainment'],
            ['id' => 9, 'name' => 'Others'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['id' => $category['id']], ['name' => $category['name']]);
        }
    }
}


