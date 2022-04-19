<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Http\Request;
use App\Models\SalaryHistory;
use App\Models\MonthWorkHistory;
use App\Models\SalaryDetails;
use App\Models\Commision;
use App\Models\AdvancePay;
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

    public function twoyears(){
      $current_year = Carbon::now()->format('Y');
      $totalFiveYear = [];
      array_push($totalFiveYear, (int)$current_year);
      for ($i=2; $i > 1 ; $i--) {
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
      return view('admin.salary_generat.index',compact('employeeId','months','years'));
    }

    // ==================== Salary Process ======================
    public function allEmployeeSalaryProcess(Request $request){
      /* ==================== Check Month Work History ==================== */
      $checkMonthWorkHistory = MonthWorkHistory::where('month_id',$request->month_name)->where('year',$request->year)->select('month_work_id','employee_id','month_id','year','overtime_amount','deduction_amount','total_work_day')->get();

      dd($checkMonthWorkHistory);


      if($checkMonthWorkHistory != ''){
        return "ok";
        // ========================
        foreach ($checkMonthWorkHistory as $monthWork) {

          $salary_details = SalaryDetails::where('employee_id',$monthWork->employee_id)->first();
          // ============ Commision Amount ============
          $commision_amount = Commision::where('employee_id',$monthWork->employee_id)->where('status',1)->where('month',$request->month_name)->where('year',$request->year)->sum('commision_amount');
          // ============ Commision Count ============
          $commision_count = Commision::where('employee_id',$monthWork->employee_id)->where('status',1)->where('month',$request->month_name)->where('year',$request->year)->count('commision_amount');
          // ============ Advance Payment ============
          $advance_payment = AdvancePay::where('employee_id',$monthWork->employee_id)->where('status',1)->where('adv_month',$request->month_name)->where('adv_year',$request->year)->sum('adv_pay_amount');
          // ============ Advance Count ============
          $advance_count = AdvancePay::where('employee_id',$monthWork->employee_id)->where('status',1)->where('adv_month',$request->month_name)->where('adv_year',$request->year)->count('adv_pay_amount');

          // ============ Store Salay In Salary History ============
          $checkSalaryHistory = SalaryHistory::where('employee_id',$monthWork->employee_id)->where('slh_month',$request->month_name)->where('slh_year',$request->year)->first();
          /*
          ======================================
          store data in database
          ======================================
          */
          if($checkSalaryHistory){

          }else{

          }

        }
        // ========================
      }else{
        Session::flash('salary_report_not_assigned');
        return redirect()->back();
      }


    }



}
