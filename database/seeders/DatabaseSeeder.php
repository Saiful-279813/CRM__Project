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
        $this->call(MonthSeeder::class);
        $this->call(BloodSeeder::class);
        $this->call(EmployeeDepartmentSeeder::class);
        $this->call(EmployeeDesignationSeeder::class);
        $this->call(EmployeeTypeSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(VisaTypeSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(SalaryDetailsSeeder::class);
        $this->call(IncomeCategorySeeder::class);
        $this->call(ExpenseCategorySeeder::class);

    }
}
