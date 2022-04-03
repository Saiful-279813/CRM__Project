<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use Carbon\Carbon;
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
        $blood = $this->getAll();
        return view('admin.blood.index',compact('blood'));
    }

    public function create()
    {
        return view('admin.blood.create');
    }

    public function store(Request $request)
    {
        /* ========== Validation ========== */
        $request->validate([
          'name' => 'required|unique:blood_groups,name',
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
          'name' => 'required'
        ]);

        /* ========== Insert Data in database ========== */
        $update = BloodGroup::where('blood_group_id',$id)->update([
          'name' => $request->name,
          'remarks' => $request->remarks,
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('success_update','value');
        return redirect()->route('blood.index');
    }
}
