<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeDesignation;

class EmployeeDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = EmployeeDesignation::create([ 'title' => 'Softwer Developer', 'remarks' => 'No Remarks' ]);
        $insert = EmployeeDesignation::create([ 'title' => 'Web Developer', 'remarks' => 'No Remarks' ]);
        $insert = EmployeeDesignation::create([ 'title' => 'App Developer', 'remarks' => 'No Remarks' ]);
        $insert = EmployeeDesignation::create([ 'title' => 'Fontend Developer', 'remarks' => 'No Remarks' ]);
    }
}
