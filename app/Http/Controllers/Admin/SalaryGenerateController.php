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
use Session;

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

      // dd($checkMonthWorkHistory);


      if(!$checkMonthWorkHistory->isEmpty()){
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
            /* =================== Update =================== */
            $update = SalaryHistory::where('employee_id',$monthWork->employee_id)->where('slh_month',$request->month_name)->where('slh_year',$request->year)->update([
              //================ Data ================
              'employee_id' => $monthWork->employee_id,
              'basic_amount' => $salary_details->basic_amount,
              'mobile_allowance' => $salary_details->mobile_allowance,
              'medical_allowance' => $salary_details->medical_allowance,
              'house_allowance' => $salary_details->house_allowance,
              'others_allowance' => $salary_details->others_allowance,
              'total_salary' => $salary_details->total_salary,
              'increment_no' => $salary_details->increment_no,
              'increment_amount' => $salary_details->increment_amount,

              'slh_overtime_amount' => $monthWork->overtime_amount,
              'slh_total_working_days' => $monthWork->total_work_day,
              'deduction_amount' => $monthWork->deduction_amount,

              'slh_advance' => $advance_count,
              'slh_advance_amount' => $advance_payment,

              'slh_commision' => $commision_count,
              'slh_commision_amount' => $commision_amount,

              'slh_salary_date' => Carbon::now(),
              'slh_month' => $request->month_name,
              'slh_year' => $request->year,
              'updated_at' => Carbon::now(),
              //================ Data ================
            ]);
            /* =================== Update =================== */
          }else{
            /* =================== Insert =================== */
            $insert = SalaryHistory::insert([
              //================ Data ================
              'employee_id' => $monthWork->employee_id,
              'basic_amount' => $salary_details->basic_amount,
              'mobile_allowance' => $salary_details->mobile_allowance,
              'medical_allowance' => $salary_details->medical_allowance,
              'house_allowance' => $salary_details->house_allowance,
              'others_allowance' => $salary_details->others_allowance,
              'total_salary' => $salary_details->total_salary,
              'increment_no' => $salary_details->increment_no,
              'increment_amount' => $salary_details->increment_amount,

              'slh_overtime_amount' => $monthWork->overtime_amount,
              'slh_total_working_days' => $monthWork->total_work_day,
              'deduction_amount' => $monthWork->deduction_amount,

              'slh_advance' => $advance_count,
              'slh_advance_amount' => $advance_payment,

              'slh_commision' => $commision_count,
              'slh_commision_amount' => $commision_amount,

              'slh_salary_date' => Carbon::now(),
              'slh_month' => $request->month_name,
              'slh_year' => $request->year,
              'updated_at' => Carbon::now(),
              //================ Data ================
            ]);
            /* =================== Insert =================== */
          }
        }
        Session::flash('success_store_salary_history');
        return redirect()->back();
        // ========================
      }else{
        Session::flash('salary_report_not_assigned');
        return redirect()->back();
      }


    }

    /* ================== Salary Report ================== */
    public function salaryReport(){
      $months = $this->months();
      $years = $this->years();
      $employeeId = $this->employeeId();
      $dataList = array();
      return view('admin.salary_generat.report',compact('employeeId','months','years', 'dataList'));
    }

    public function salaryReportProcess(Request $request){
      $dataList = SalaryHistory::where('slh_month',$request->month_name)
                               ->where('slh_year',$request->year)
                               ->leftjoin('employees','salary_histories.employee_id','=','employees.employee_id')
                               ->select(
                                 'employees.ID_Number',
                                 'employees.employee_name',
                                 'employees.profile_photo',
                                 /* Salary History */
                                 'salary_histories.slh_auto_id',
                                 'salary_histories.basic_amount',
                                 'salary_histories.total_salary',
                                 'salary_histories.slh_overtime_amount',
                                 'salary_histories.slh_total_working_days',
                                 'salary_histories.deduction_amount',
                                 'salary_histories.slh_advance',
                                 'salary_histories.slh_advance_amount',
                                 'salary_histories.slh_commision',
                                 'salary_histories.slh_commision_amount',
                                 )
                               ->get();
      return redirect()->back()->with(['dataList' => $dataList]);
    }
    /* =============== salary report view =============== */
    public function getSalaryData($id){
      return $dataList = SalaryHistory::where('slh_auto_id',$id)
                               ->leftjoin('employees','salary_histories.employee_id','=','employees.employee_id')
                               ->leftjoin('months','salary_histories.slh_month','=','months.month_id')
                               ->select(
                                 'employees.ID_Number',
                                 'employees.employee_name',
                                 'employees.profile_photo',
                                 'months.month_name',
                                 /* Salary History */
                                 'salary_histories.*',
                                 )
                               ->first();
    }

    public function salaryReportView($id){
      $data = $this->getSalaryData($id);
      // dd($data);
      return view('admin.salary_generat.report_view',compact('data'));
    }
    /* =============== salary report download =============== */
    public function salaryReportDownload($id){
      $data = $this->getSalaryData($id);
    }





}
