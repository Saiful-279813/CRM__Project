<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Month;
use Carbon\Carbon;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /* ==== Do Work ==== */
      Month::truncate();
      $months = [
          [
            /* ========== Do Work ========== */
            'month_name' => 'January',
            'month_days' => 31,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'February',
            'month_days' => 28,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'March',
            'month_days' => 31,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'April',
            'month_days' => 30,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'May',
            'month_days' => 31,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'June',
            'month_days' => 30,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'July',
            'month_days' => 31,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'August',
            'month_days' => 31,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'September',
            'month_days' => 30,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'October',
            'month_days' => 31,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'November',
            'month_days' => 30,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
          [
            /* ========== Do Work ========== */
            'month_name' => 'December',
            'month_days' => 31,
            'created_at' => Carbon::now(),
            /* ========== Do Work ========== */
          ],
      ];
      foreach ($months as $key => $value) {
          Month::create($value);
      }
      /* ==== Do Work ==== */
    }
}
