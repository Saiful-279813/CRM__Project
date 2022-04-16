<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncomeCategory;
use Carbon\Carbon;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /* ==== Do Work ==== */
      IncomeCategory::truncate();
      $incomeCategory = [
          [
            /* ========== Do Work ========== */
            'in_cat_name' => 'Hosting Bill',
            'in_cat_remarks' => 'No Remarks',
            'in_cat_creator' => 1,
            'in_cat_slug' => strtolower(str_replace(' ','-','Hosting Bill')),
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'in_cat_name' => 'Software Bill',
            'in_cat_remarks' => 'No Remarks',
            'in_cat_creator' => 1,
            'in_cat_slug' => strtolower(str_replace(' ','-','Hosting Bill')),
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'in_cat_name' => 'App Bill',
            'in_cat_remarks' => 'No Remarks',
            'in_cat_creator' => 1,
            'in_cat_slug' => strtolower(str_replace(' ','-','Hosting Bill')),
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'in_cat_name' => 'Bus Bill',
            'in_cat_remarks' => 'No Remarks',
            'in_cat_creator' => 1,
            'in_cat_slug' => strtolower(str_replace(' ','-','Hosting Bill')),
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            /* ========== Do Work ========== */
          ],
      ];
      foreach ($incomeCategory as $key => $value) {
          IncomeCategory::create($value);
      }
      /* ==== Do Work ==== */
    }
}
