<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeType;

class EmployeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = EmployeeType::create([ 'title' => 'Part Time', 'remarks' => 'No Remarks' ]);
        $insert = EmployeeType::create([ 'title' => 'Full Time', 'remarks' => 'No Remarks' ]);
        $insert = EmployeeType::create([ 'title' => 'Home Office', 'remarks' => 'No Remarks' ]);
    }
}
