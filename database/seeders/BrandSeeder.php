<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = Brand::create([
          'brand_name' => 'others',
          'brand_slug' => 'others',
          'user' => 1,
        ]);
    }
}
