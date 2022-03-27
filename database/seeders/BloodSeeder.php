<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BloodGroup;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = BloodGroup::create([ 'name' => 'AB+', 'remarks' => 'No Remarks' ]);
        $insert = BloodGroup::create([ 'name' => 'AB-', 'remarks' => 'No Remarks' ]);
        $insert = BloodGroup::create([ 'name' => 'O+', 'remarks' => 'No Remarks' ]);
        $insert = BloodGroup::create([ 'name' => 'O-', 'remarks' => 'No Remarks' ]);
        $insert = BloodGroup::create([ 'name' => 'B+', 'remarks' => 'No Remarks' ]);
    }
}
