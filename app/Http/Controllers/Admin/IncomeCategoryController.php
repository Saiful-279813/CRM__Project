<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use Carbon\Carbon;
use Session;
use Auth;

class IncomeCategoryController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = IncomeCategory::orderBy('in_cat_id','DESC')->get();
    }

    public function getSomeAll(){
      return $data = IncomeCategory::select('in_cat_id','in_cat_name')->orderBy('in_cat_id','DESC')->get();
    }

    public function findData($id){
      return $data = IncomeCategory::where('in_cat_id',$id)->first();
    }


    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/

    public function index()
    {
        $category = $this->getAll();
        return view('admin.income_category.index',compact('category'));
    }

    public function create()
    {
        return view('admin.income_category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'in_cat_name'=>'required|unique:income_categories,in_cat_name'
        ],[
          'in_cat_name.required'=>'Please enter Income Category name!',
        ]);
        /* ============= Insert data in database ============= */
        $insert=IncomeCategory::insert([
          'in_cat_name'=> $request->in_cat_name,
          'in_cat_remarks'=> $request->in_cat_remarks,
          'in_cat_creator'=> Auth::user()->id,
          'in_cat_slug'=> strtolower(str_replace(' ','-',$request->in_cat_name)),
          'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        Session::flash('success_store');
        return redirect()->back();
    }

    public function show($id)
    {
        $data = $this->findData($id);
        return view('admin.income_category.view',compact('data'));
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        return view('admin.income_category.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
          'in_cat_name'=>'required|unique:income_categories,in_cat_name,'.$id.',in_cat_id'
        ],[
          'in_cat_name.required'=>'Please enter Income Category name!',
        ]);
        /* ============= Insert data in database ============= */
        $update = IncomeCategory::where('in_cat_id',$id)->update([
          'in_cat_name'=> $request->in_cat_name,
          'in_cat_remarks'=> $request->in_cat_remarks,
          'in_cat_creator'=> Auth::user()->id,
          'in_cat_slug'=> strtolower(str_replace(' ','-',$request->in_cat_name)),
          'updated_at'=> Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        Session::flash('success_update');
        return redirect()->route('income-category.index');

    }

}
