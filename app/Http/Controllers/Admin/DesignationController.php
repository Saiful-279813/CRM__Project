<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeDesignation;
use Carbon\Carbon;
use Session;

class DesignationController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = EmployeeDesignation::orderBy('designation_id','DESC')->get();
    }

    public function findData($id){
      return $data = EmployeeDesignation::where('designation_id',$id)->first();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $designation = $this->getAll();
        return view('admin.designation.index',compact('designation'));
    }

    public function create()
    {
        return view('admin.designation.create');
    }

    public function store(Request $request)
    {
        /* ========== Validation ========== */
        $request->validate([
          'title' => 'required|unique:employee_designations,title',
        ]);
        /* ========== Insert Data in database ========== */
        $data =  $request->all();
        $insert = EmployeeDesignation::create($data);
        Session::flash('success_store','value');
        return redirect()->back();
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        return view('admin.designation.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        /* ========== Validation ========== */
        $request->validate([
          'title' => 'required'
        ]);
        /* ========== Insert Data in database ========== */
        $update = EmployeeDesignation::where('designation_id',$id)->update([
          'title' => $request->title,
          'remarks' => $request->remarks,
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('success_update','value');
        return redirect()->route('designation.index');
    }
}
