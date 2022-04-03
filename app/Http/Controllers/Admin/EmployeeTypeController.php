<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeType;
use Carbon\Carbon;
use Session;

class EmployeeTypeController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = EmployeeType::orderBy('emp_type_id','DESC')->get();
    }

    public function findData($id){
      return $data = EmployeeType::where('emp_type_id',$id)->first();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $employeeType = $this->getAll();
        return view('admin.emptype.index',compact('employeeType'));
    }

    public function create()
    {
        return view('admin.emptype.create');
    }

    public function store(Request $request)
    {
        /* ========== Validation ========== */
        $request->validate([
          'title' => 'required|unique:employee_types,title',
        ]);
        /* ========== Insert Data in database ========== */
        $data =  $request->all();
        $insert = EmployeeType::create($data);
        Session::flash('success_store','value');
        return redirect()->back();
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        return view('admin.emptype.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        /* ========== Validation ========== */
        $request->validate([
          'title' => 'required'
        ]);
        /* ========== Insert Data in database ========== */
        $update = EmployeeType::where('emp_type_id',$id)->update([
          'title' => $request->title,
          'remarks' => $request->remarks,
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('success_update','value');
        return redirect()->route('employee-type.index');
    }
}
