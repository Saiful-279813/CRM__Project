<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryDetails;
use Carbon\Carbon;
use Session;

class SalaryController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = SalaryDetails::orderBy('sdetails_id','DESC')->get();
    }

    public function findData($id){
      return $data = SalaryDetails::where('sdetails_id',$id)->first();
    }

    public function totalEmployeeHistory(){
      return $data = SalaryDetails::leftjoin('employees','salary_details.employee_id','=','employees.employee_id')
                                    ->select('employees.employee_id','employees.ID_Number','employees.employee_name','salary_details.*')->get();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/

    public function index()
    {
        $salary = $this->totalEmployeeHistory();
        return view('admin.salary.index',compact('salary'));
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        return view('admin.salary.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        /* =============== Form Validation =============== */
        $request->validate([
          'basic_amount' => 'required|numeric',
          'mobile_allowance' => 'required|numeric',
          'others_allowance' => 'required|numeric',
        ]);
        /* =============== Insert Data in database =============== */
        $update = SalaryDetails::where('sdetails_id',$id)->update([
          'basic_amount' => $request->basic_amount,
          'mobile_allowance' => $request->mobile_allowance,
          'others_allowance' => $request->others_allowance,
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('save_and_change');
        return redirect()->back();
    }

}
