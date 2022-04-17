<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Http\Request;
use App\Models\Commision;
use Carbon\Carbon;
use Session;
use Auth;

class ComissionController extends Controller
{

    public function employeeId(){
      $employeeOBJ = new EmployeeController();
      return $employeeId = $employeeOBJ->getAllEmployeeId();
    }

    public function commision(){
      return $data = Commision::leftjoin('employees','commisions.employee_id','=','employees.employee_id')
                             ->leftjoin('salary_details','employees.employee_id','=','salary_details.employee_id')
                             ->select(
                               'salary_details.sdetails_id',
                               'salary_details.basic_amount',
                               'employees.employee_id',
                               'employees.ID_Number',
                               'employees.employee_name',
                               'commisions.id',
                               'commisions.commision_amount',
                               'commisions.entry_date',
                               'commisions.remarks',
                               'commisions.status',
                               )->orderBy('id','DESC')->get();
    }

    public function index()
    {
        $dataList = $this->commision();
        return view('admin.commision.index',compact('dataList'));
    }



    public function create()
    {
        $employeeId = $this->employeeId();
        return view('admin.commision.create',compact('employeeId'));
    }

    public function store(Request $request)
    {
        $request->validate([
          'employee_id' => 'required',
          'commision_amount' => 'required',
          'remarks' => 'required|max:240',
        ]);
        // insert data in database
        $times = Carbon::now();
        $data = Commision::insert([
          'employee_id' => $request->employee_id,
          'commision_amount' => $request->commision_amount,
          'remarks' => $request->remarks,
          // ==== Time maintant ====
          'entry_date' => $times,
          'month' => $times->format('m'),
          'year' => $times->format('Y'),
          'creator' => Auth::user()->id,
          'created_at' => Carbon::now(),
        ]);

        Session::flash('requestSend');
        return redirect()->back();

    }

    public function edit($id)
    {
        $data = Commision::where('id',$id)->first();
        $employeeId = $this->employeeId();
        return view('admin.commision.edit',compact('employeeId','data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
          'employee_id' => 'required',
          'commision_amount' => 'required',
          'remarks' => 'required|max:240',
        ]);
        // insert data in database
        $times = Carbon::now();
        $data = Commision::where('id',$id)->update([
          'employee_id' => $request->employee_id,
          'commision_amount' => $request->commision_amount,
          'remarks' => $request->remarks,
          // ==== Time maintant ====
          'entry_date' => $times,
          'month' => $times->format('m'),
          'year' => $times->format('Y'),
          'creator' => Auth::user()->id,
          'updated_at' => Carbon::now(),
        ]);

        Session::flash('requestUpdate');
        return redirect()->route('commision.index');
    }

    public function delete($id)
    {
        $data = Commision::where('id',$id)->delete();
        Session::flash('delete_success');
        return redirect()->route('commision.index');
    }

    // ============= Pending Commision ==================
    public function pendingCommision(){
      $dataList = $this->commision();
      return view('admin.commision.administrator.index',compact('dataList'));
    }

    public function commisionApprove($id){
        $data = Commision::where('status',0)->where('id',$id)->update([
          'status' => 1,
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('approve_success');
        return redirect()->back();
    }
    // ============= Pending Commision ==================
}
