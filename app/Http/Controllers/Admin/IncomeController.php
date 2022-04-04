<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\IncomeCategoryController;
use Illuminate\Http\Request;
use App\Models\Income;
use Carbon\Carbon;
use Session;
use Auth;

class IncomeController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = Income::leftjoin('income_categories','incomes.in_cat_id','=','income_categories.in_cat_id')
                     ->select('incomes.*','income_categories.in_cat_name')
                     ->orderBy('income_id','DESC')->get();
    }

    public function findData($id){
      return $data = Income::where('income_id',$id)
                    ->leftjoin('income_categories','incomes.in_cat_id','=','income_categories.in_cat_id')
                    ->select('incomes.*','income_categories.in_cat_name')
                    ->first();
    }

    public function category(){
      $categoryOBJ = new IncomeCategoryController();
      return $category = $categoryOBJ->getSomeAll();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/

    public function index()
    {
        $income = $this->getAll();
        return view('admin.income.index',compact('income'));
    }

    public function create()
    {
        $category = $this->category();
        return view('admin.income.create',compact('category'));
    }

    public function store(Request $request)
    {
      /* ============= Form Validation ============= */
      $this->validate($request,[
        'in_cat_id'=>'required',
        'in_cat_remarks'=>'required',
        'income_amount'=>'required|numeric',
        'date'=>'required',
      ]);
      /* ============= Form Validation ============= */
      $insert=Income::insert([
        'in_cat_id' => $request['in_cat_id'],
        'income_date' => $request['date'],
        'income_amount' => $request['income_amount'],
        'income_details'=> $request['in_cat_remarks'],
        'income_creator' => Auth::user()->id,
        'income_slug' => uniqid('income'),
        'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
      ]);
      Session::flash('success_store');
      return redirect()->back();
    }

    public function show($id)
    {
        $data = $this->findData($id);
        return view('admin.income.view',compact('data'));
    }

    public function edit($id)
    {
        $category = $this->category();
        $data = $this->findData($id);
        return view('admin.income.edit',compact('data','category'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
          'exp_cat_name'=>'required|unique:expanse_categories,exp_cat_name,'.$id.',income_id'
        ],[
          'exp_cat_name.required'=>'Please enter Income Category name!',
        ]);
        /* ============= Insert data in database ============= */
        $update = Income::where('income_id',$id)->update([
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
