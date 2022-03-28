<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\SalaryDetails;
use Carbon\Carbon;
use Session;
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
          ['name' => 'Afghanistan', 'code' => 'AF'],
      ];
      foreach ($Employee as $key => $value) {
          Employee::create($value);
      }
      /* ==== Do Work ==== */
    }
}
