<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisaType;
use Carbon\Carbon;
use Session;

class VisaTypeController extends Controller
{

    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = VisaType::orderBy('visa_type_id','DESC')->get();
    }

    public function getSomeAll(){
      return $data = VisaType::orderBy('visa_type_id','DESC')->select(
        'visa_type_id',
        'visa_type_name',
        )->get();
    }

    public function findData($id){
      return $data = VisaType::where('visa_type_id',$id)->first();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/

    public function index()
    {
        $visaType = $this->getAll();
        return view('admin.visa_type.index',compact('visaType'));
    }

    public function create()
    {
        return view('admin.visa_type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
          'visa_type_name' => 'required|max:60',
          'visa_type_remarks' => 'required|max:250',
        ]);

        $insert = VisaType::create($request->all());
        Session::flash('success_store','value');
        return redirect()->back();
    }

    public function edit($id){
       $data = $this->findData($id);
       return view('admin.visa_type.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
          'visa_type_name' => 'required|max:60',
          'visa_type_remarks' => 'required|max:250',
        ]);

        $update = VisaType::where('visa_type_id',$id)->update([
          'visa_type_name' => $request->visa_type_name,
          'visa_type_remarks' => $request->visa_type_remarks,
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('success_update','value');
        return redirect()->route('visa-type.index');
    }

}
