<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Http\Request;
use App\Models\Month;
use Carbon\Carbon;

class SalaryGenerateController extends Controller
{
    // month
    public function months(){
      return $months = Month::orderBy('month_id','ASC')->get();
    }

    public function years(){
      $current_year = Carbon::now()->format('Y');
      $totalFiveYear = [];
      array_push($totalFiveYear, (int)$current_year);
      for ($i=5; $i > 1 ; $i--) {
          $current_year = $current_year-1 ;
        array_push($totalFiveYear, $current_year);
      }
      return $totalFiveYear;
    }

    public function employeeId(){
      $employeeOBJ = new EmployeeController();
      return $employeeId = $employeeOBJ->getAllEmployeeId();
    }

    public function index()
    {
      $months = $this->months();
      $years = $this->years();
      $employeeId = $this->employeeId();
      dd($employeeId);
      return view('admin.salary_generat.index',compact('employeeId','months','years'));
    }
}
