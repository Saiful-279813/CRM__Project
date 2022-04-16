<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpanseCategory;
use Carbon\Carbon;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /* ==== Do Work ==== */
      ExpanseCategory::truncate();
      $expenseCategory = [
          [
            /* ========== Do Work ========== */
            'exp_cat_name' => 'House Rent',
            'exp_cat_remarks' => 'No Remarks',
            'exp_cat_creator' => 1,
            'exp_cat_slug' => strtolower(str_replace(' ','-','House Rent')),
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'exp_cat_name' => 'Employee Salary',
            'exp_cat_remarks' => 'No Remarks',
            'exp_cat_creator' => 1,
            'exp_cat_slug' => strtolower(str_replace(' ','-','House Rent')),
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'exp_cat_name' => 'Net Bill',
            'exp_cat_remarks' => 'No Remarks',
            'exp_cat_creator' => 1,
            'exp_cat_slug' => strtolower(str_replace(' ','-','House Rent')),
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            /* ========== Do Work ========== */
          ],
      ];
      foreach ($expenseCategory as $key => $value) {
          ExpanseCategory::create($value);
      }
      /* ==== Do Work ==== */
    }
}
