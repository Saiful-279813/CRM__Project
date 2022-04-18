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



    /*
    ===================================
    BLADE OPERATION
    ===================================
    */

    public function index()
    {
        $months = $this->salaryGenerateOBJ()->months();
        $years = $this->salaryGenerateOBJ()->twoyears();
        $employeeId = $this->employeeId();
        return view('admin.month_work.index',compact('employeeId','months','years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
