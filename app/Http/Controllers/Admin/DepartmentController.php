<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeDepartment;
use Session;

class DepartmentController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = EmployeeDepartment::orderBy('department_id','DESC')->get();
    }

    public function findData($id){
      return $data = EmployeeDepartment::where('department_id',$id)->first();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $data = $this->getAll();
        return view('admin.department.index',compact('data'));
    }
    
    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request)
    {
        /* ========== Validation ========== */
        $request->validate([
          'title' => 'required|unique:employee_departments,title',
        ]);
        /* ========== Insert Data in database ========== */
        $data =  $request->all();
        $insert = EmployeeDepartment::create($data);
        Session::flash('success_store','value');
        return redirect()->back();
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        return view('admin.department.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        /* ========== Validation ========== */
        $request->validate([
          'title' => 'required|unique:employee_departments,title,'.$id
        ]);
        /* ========== Insert Data in database ========== */
        $update = EmployeeDepartment::where('department_id',$id)->update([
          'title' => $request->title,
          'remarks' => $request->remarks,
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('success_update','value');
        return redirect()->back();
    }

}
