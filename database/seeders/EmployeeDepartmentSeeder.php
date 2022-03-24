<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeDepartment;

class EmployeeDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = EmployeeDepartment::create([ 'title' => 'Softwer Department', 'remarks' => 'No Remarks' ]);
        $insert = EmployeeDepartment::create([ 'title' => 'Hosting Department', 'remarks' => 'No Remarks' ]);
        $insert = EmployeeDepartment::create([ 'title' => 'Orbit Department', 'remarks' => 'No Remarks' ]);
    }
}
