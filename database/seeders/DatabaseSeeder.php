<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\ThirdCategory;
use Illuminate\Database\Seeder;

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
        $this->call(RoleSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(PermissionTableSeeder::class);

        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(ThirdCategorySeeder::class);

        // factory call
        \App\Models\Brand::factory(7)->create();
        \App\Models\Category::factory(7)->create();
        \App\Models\SubCategory::factory(7)->create();
        \App\Models\ThirdCategory::factory(7)->create();
        \App\Models\Product::factory(15)->create();
        \App\Models\ProductImage::factory(40)->create();
        // factory call
    }
}
