<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpanseCategory;
use Carbon\Carbon;
use Session;
use Auth;

class ExpenseCategoryController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = ExpanseCategory::orderBy('exp_cat_id','DESC')->get();
    }

    public function getSomeAll(){
      return $data = ExpanseCategory::select('exp_cat_id','exp_cat_name')->orderBy('exp_cat_id','DESC')->get();
    }

    public function findData($id){
      return $data = ExpanseCategory::where('exp_cat_id',$id)->first();
    }


    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/

    public function index()
    {
        $category = $this->getAll();
        return view('admin.expense_category.index',compact('category'));
    }

    public function create()
    {
        return view('admin.expense_category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'exp_cat_name'=>'required|unique:expanse_categories,exp_cat_name'
        ],[
          'exp_cat_name.required'=>'Please enter Expense Category name!',
        ]);
        /* ============= Insert data in database ============= */
        $insert = ExpanseCategory::insert([
          'exp_cat_name' => $request->exp_cat_name,
          'exp_cat_remarks' => $request->exp_cat_remarks,
          'exp_cat_creator' => Auth::user()->id,
          'exp_cat_slug' => strtolower(str_replace(' ','-',$request->exp_cat_name)),
          'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        Session::flash('success_store');
        return redirect()->back();
    }

    public function show($id)
    {
        $data = $this->findData($id);
        return view('admin.expense_category.view',compact('data'));
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        return view('admin.expense_category.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
          'exp_cat_name'=>'required|unique:expanse_categories,exp_cat_name,'.$id.',exp_cat_id'
        ],[
          'exp_cat_name.required'=>'Please enter Income Category name!',
        ]);
        /* ============= Insert data in database ============= */
        $update = ExpanseCategory::where('exp_cat_id',$id)->update([
          'exp_cat_name' => $request->exp_cat_name,
          'exp_cat_remarks' => $request->exp_cat_remarks,
          'exp_cat_creator' => Auth::user()->id,
          'exp_cat_slug' => strtolower(str_replace(' ','-',$request->exp_cat_name)),
          'updated_at'=> Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        Session::flash('success_update');
        return redirect()->route('expense-category.index');

    }


}
