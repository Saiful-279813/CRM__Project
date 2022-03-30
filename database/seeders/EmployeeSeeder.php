<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Carbon\Carbon;
use Image;
use Auth;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /* ==== Do Work ==== */
      Employee::truncate();
      $Employee = [
          [
            /* ========== Do Work ========== */
            'ID_Number' => 'E100',
            'employee_name' => 'Saiful Islam',
            'employee_father' => 'Amir Hossain',
            'employee_mother' => 'Moni Begum',
            'mobile_no' => '01730233598',
            'nid' => '209039009',
            'blood_group_id' => 1,
            'present_address' => 'Dhaka Mohakhali',
            'parmanent_address' => 'Jangalia Bagarhat Bhola',
            'date_of_birth' => '2004-03-29',
            'maritus_status' => 0,
            'gender' => 'Male',
            'joining_date' => Carbon::now(),
            'confirmation_date' => Carbon::now(),
            'appointment_date' => Carbon::now(),
            'designation_id' => 1,
            'department_id' => 1,
            'emp_type_id' => 1,
            'profile_photo' => 'uploads/employee/image-E100-jpg',
            'employee_slug' => strtolower(str_replace(' ','-','Saiful Islam')),
            'employee_creator' => 1,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'ID_Number' => 'E101',
            'employee_name' => 'Safrin Jahan',
            'employee_father' => 'Unknow',
            'employee_mother' => 'Unkhow',
            'mobile_no' => '01730233599',
            'nid' => '209039008',
            'blood_group_id' => 1,
            'present_address' => 'Dhaka Mohakhali',
            'parmanent_address' => 'Jangalia Bagarhat Bhola',
            'date_of_birth' => '2004-03-29',
            'maritus_status' => 0,
            'gender' => 'Fmale',
            'joining_date' => Carbon::now(),
            'confirmation_date' => Carbon::now(),
            'appointment_date' => Carbon::now(),
            'designation_id' => 1,
            'department_id' => 1,
            'emp_type_id' => 1,
            'profile_photo' => 'uploads/employee/image-E100-jpg',
            'employee_slug' => strtolower(str_replace(' ','-','Safrin Jahan')),
            'employee_creator' => 1,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
      ];
      foreach ($Employee as $key => $value) {
          Employee::create($value);
      }
      /* ==== Do Work ==== */
    }
}
