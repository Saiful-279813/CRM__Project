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
        $insert = BloodGroup::create([ 'title' => 'AB+', 'remarks' => 'No Remarks' ]);
        $insert = BloodGroup::create([ 'title' => 'AB-', 'remarks' => 'No Remarks' ]);
        $insert = BloodGroup::create([ 'title' => 'O+', 'remarks' => 'No Remarks' ]);
        $insert = BloodGroup::create([ 'title' => 'O-', 'remarks' => 'No Remarks' ]);
        $insert = BloodGroup::create([ 'title' => 'B+', 'remarks' => 'No Remarks' ]);
    }
}
