<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use Session;

class BloodGroupController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = BloodGroup::orderBy('blood_group_id','DESC')->get();
    }

    public function findData($id){
      return $data = BloodGroup::where('blood_group_id',$id)->first();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $data = $this->getAll();
        return view('admin.blood.index',compact('data'));
    }

    public function create()
    {
        return view('admin.blood.create');
    }

    public function store(Request $request)
    {
        /* ========== Validation ========== */
        $request->validate([
          'title' => 'required|unique:blood_groups,title',
        ]);
        /* ========== Insert Data in database ========== */
        $data =  $request->all();
        $insert = BloodGroup::create($data);
        Session::flash('success_store','value');
        return redirect()->back();
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        return view('admin.blood.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        /* ========== Validation ========== */
        $request->validate([
          'title' => 'required|unique:blood_groups,title,'.$id
        ]);
        /* ========== Insert Data in database ========== */
        $update = BloodGroup::where('blood_group_id',$id)->update([
          'title' => $request->title,
          'remarks' => $request->remarks,
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('success_update','value');
        return redirect()->back();
    }
}
