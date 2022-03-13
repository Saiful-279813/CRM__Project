<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert default data
        SubCategory::create([
          'category_id' => 1,
          'subcategory_name' => 'others',
          'subcategory_slug' => 'others',
          'user' => 1,
        ]);
        // insert default data
    }
}
