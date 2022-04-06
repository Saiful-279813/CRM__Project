<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expanse;
use Carbon\Carbon;
use Session;
use Auth;

class IncomeExpenseSummaryController extends Controller{
    public function index(){
      $incomes =  Income::where('income_status', '=', 1)->orderBy('income_date','DESC')->get();
      $incomeTotal =  Income::where('income_status', '=', 1)->sum('income_amount');
      $expense =  Expanse::where('expens_status', '=', 1)->orderBy('expens_date','DESC')->get();
      $expenseTotal =  Expanse::where('expens_status', '=', 1)->sum('expens_amount');
      return view('admin.summary.index',compact('incomes','expense','incomeTotal','expenseTotal'));
    }
}
