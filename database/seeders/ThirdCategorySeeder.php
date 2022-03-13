<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ThirdCategory;

class ThirdCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ThirdCategory::create([
          'category_id' => 1,
          'subcategory_id' => 1,
          'thirdcategory_name' => 'others',
          'thirdcategory_slug' => 'others',
          'user' => 1,
        ]);
    }
}
