<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use Illuminate\Http\Request;
use App\Models\Expanse;
use Carbon\Carbon;
use Session;
use Auth;

class ExpenseController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = Expanse::leftjoin('expanse_categories','expanses.exp_cat_id','=','expanse_categories.exp_cat_id')
                     ->select('expanses.*','expanse_categories.exp_cat_name')
                     ->orderBy('expens_id','DESC')->get();
    }

    public function findData($id){
      return $data = Expanse::where('expens_id',$id)
                    ->leftjoin('expanse_categories','expanses.exp_cat_id','=','expanse_categories.exp_cat_id')
                    ->select('expanses.*','expanse_categories.exp_cat_name')
                    ->first();
    }

    public function category(){
      $categoryOBJ = new ExpenseCategoryController();
      return $category = $categoryOBJ->getSomeAll();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/

    public function index()
    {
        $expens = $this->getAll();
        return view('admin.expense.index',compact('expens'));
    }

    public function create()
    {
        $category = $this->category();
        return view('admin.expense.create',compact('category'));
    }

    public function store(Request $request)
    {
      /* ============= Form Validation ============= */
      $this->validate($request,[
        'exp_cat_id'=>'required',
        'expens_details'=>'required',
        'expens_amount'=>'required|numeric',
        'expens_date'=>'required',
      ]);
      /* ============= Form Validation ============= */
      $insert=Expanse::insert([
        'exp_cat_id' => $request['exp_cat_id'],
        'expens_date' => $request['expens_date'],
        'expens_amount' => $request['expens_amount'],
        'expens_details'=> $request['expens_details'],
        'expens_creator' => Auth::user()->id,
        'expens_slug' => uniqid('expense'),
        'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
      ]);
      Session::flash('success_store');
      return redirect()->back();
    }

    public function show($id)
    {
        $data = $this->findData($id);
        return view('admin.expense.view',compact('data'));
    }

    public function edit($id)
    {
        $category = $this->category();
        $data = $this->findData($id);
        return view('admin.expense.edit',compact('data','category'));
    }

    public function update(Request $request, $id)
    {
        /* ============= Form Validation ============= */
        $this->validate($request,[
          'exp_cat_id'=>'required',
          'expens_details'=>'required',
          'expens_amount'=>'required|numeric',
          'expens_date'=>'required',
        ]);
        /* ============= Form Validation ============= */
        $update = Expanse::where('expens_id',$id)->update([
            'exp_cat_id' => $request['exp_cat_id'],
            'expens_date' => $request['expens_date'],
            'expens_amount' => $request['expens_amount'],
            'expens_details'=> $request['expens_details'],
            'expens_creator' => Auth::user()->id,
            'expens_slug' => uniqid('expense'),
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        Session::flash('success_update');
        return redirect()->route('expense.index');

    }
}
