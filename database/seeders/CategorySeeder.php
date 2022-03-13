<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert data
        Category::create([
          'category_name' => 'others',
          'category_slug' => 'others',
          'user' => 1,
        ]);
        // insert data
    }
}
