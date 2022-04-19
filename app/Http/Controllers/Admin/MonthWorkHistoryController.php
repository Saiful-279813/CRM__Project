<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SalaryGenerateController;
use Illuminate\Http\Request;
use App\Models\MonthWorkHistory;
use Carbon\Carbon;
use Session;
use Auth;

class MonthWorkHistoryController extends Controller
{
    /*
    ===================================
    DATABASE OPERATION
    ===================================
    */
    public function employeeId(){
      $employeeOBJ = new EmployeeController;
      return $employeeId = $employeeOBJ->getAllEmployeeId();
    }

    public function salaryGenerateOBJ(){
      return $obj = new SalaryGenerateController;
    }

    public function getAll(){
      return $data = MonthWorkHistory::leftjoin('employees','month_work_histories.employee_id','=','employees.employee_id')
                                      ->leftjoin('months','month_work_histories.month_id','=','months.month_id')
                                      ->select(
                                        'employees.ID_Number',
                                        'employees.employee_name',
                                        'months.month_name',
                                        /* Month Work */
                                        'month_work_histories.*'
                                        )
                                      ->orderBy('month_work_id','DESC')->get();
    }

    public function findData($id){
      return $data = MonthWorkHistory::where('month_work_id',$id)->first();
    }

    /*
    ===================================
    BLADE OPERATION
    ===================================
    */

    public function index()
    {
        $mothWorkList = $this->getAll();
        $months = $this->salaryGenerateOBJ()->months();
        $years = $this->salaryGenerateOBJ()->twoyears();
        $employeeId = $this->employeeId();
        return view('admin.month_work.index',compact('employeeId','months','years','mothWorkList'));
    }

    public function store(Request $request)
    {
        // ========== validation ==========
        $request->validate([
          'employee_id' => 'required',
          'month_name' => 'required',
          'year' => 'required',
          'overtime_amount' => 'required|numeric',
          'deduction_amount' => 'required|numeric',
          'total_work_day' => 'required|numeric|max:30',
        ]);
        // ========== insert data in database ==========
        $check = MonthWorkHistory::where('year',$request->year)->where('month_id',$request->month_name)->where('employee_id',$request->employee_id)->first();

        if($check){
          Session::flash('already_exist');
          return redirect()->back();
        }else{
          // ========= insert data in database ===========
          $insert = MonthWorkHistory::insert([
            'employee_id' => $request->employee_id,
            'month_id' => $request->month_name,
            'year' => $request->year,
            'overtime_amount' => $request->overtime_amount,
            'deduction_amount' => $request->deduction_amount,
            'total_work_day' => $request->total_work_day,
            'create_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
          ]);
          // ========= insert data in database ===========
        }

        Session::flash('success_store');
        return redirect()->back();
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        $months = $this->salaryGenerateOBJ()->months();
        $years = $this->salaryGenerateOBJ()->twoyears();
        $employeeId = $this->employeeId();
        return view('admin.month_work.edit',compact('employeeId','months','years','data'));
    }

    public function update(Request $request, $id)
    {
        // ========== validation ==========
        $request->validate([
          'employee_id' => 'required',
          'month_name' => 'required',
          'year' => 'required',
          'overtime_amount' => 'required|numeric',
          'deduction_amount' => 'required|numeric',
          'total_work_day' => 'required|numeric|max:30',
        ]);
        // ========= insert data in database ===========
        $update = MonthWorkHistory::where('month_work_id',$id)->update([
          'employee_id' => $request->employee_id,
          'month_id' => $request->month_name,
          'year' => $request->year,
          'overtime_amount' => $request->overtime_amount,
          'deduction_amount' => $request->deduction_amount,
          'total_work_day' => $request->total_work_day,
          'create_by' => Auth::user()->id,
          'updated_at' => Carbon::now(),
        ]);
        // ========= insert data in database ===========
        Session::flash('success_update');
        return redirect()->back();
    }

    public function delete($id){
      $delete = MonthWorkHistory::where('status',0)->where('month_work_id',$id)->delete();
      Session::flash('success_delete');
      return redirect()->back();
    }
    /* ============ Approve section ============ */

}
