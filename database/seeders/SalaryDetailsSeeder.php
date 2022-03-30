<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalaryDetails;
use Carbon\Carbon;

class SalaryDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ==== Do salary ==== */
        SalaryDetails::truncate();
        $salary = [
            [
              /* ========== Do Work ========== */
              'employee_id' => 1,
              'created_at' => Carbon::now(),
              /* ========== Do Work ========== */
            ],
            [
              /* ========== Do Work ========== */
              'employee_id' => 2,
              'created_at' => Carbon::now(),
              /* ========== Do Work ========== */
            ],
        ];
        foreach ($salary as $key => $value) {
            SalaryDetails::create($value);
        }
        /* ==== Do Work ==== */
    }
}
