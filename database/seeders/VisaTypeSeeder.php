<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisaType;

class VisaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /* ==== Do Work ==== */
      VisaType::truncate();
      $visaType = [
        ['visa_type_name' => 'Government Delegates Visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Diplomatic/ Other Embassy Officials Visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'UN/ International Organizations Visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Business visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Tourist visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Investor visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Work / Employment visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'NGO workers’ visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Expert Visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Student visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Research Visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Tablig Jamaat visa', 'visa_type_remarks' => 'No Remarks'],
        ['visa_type_name' => 'Journalist visa', 'visa_type_remarks' => 'No Remarks'],
      ];

      foreach ($visaType as $key => $value) {
          VisaType::create($value);
      }
      /* ==== Do Work ==== */
    }
}
