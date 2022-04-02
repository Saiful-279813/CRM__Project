<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerTransactions;
use Carbon\Carbon;
use Session;

class CustomerTransactionController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = CustomerTransactions::orderBy('customer_id','DESC')->get();
    }

    public function getTwoTable(){
      return $data = CustomerTransactions::leftjoin('customers','customer_transactions.customer_id','=','customers.customer_id')
                             ->select(
                               'customer_transactions.*',
                               'customers.customer_id',
                               'customers.customer_id_number',
                               'customers.customer_name',
                               )->get();
    }

    public function findData($id){
      return $data = CustomerTransactions::where('customer_id',$id)->first();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $transaction = $this->getTwoTable();
        return view('admin.customer_transaction.index',compact('transaction'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->findData($id);
        return view('admin.customer_transaction.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        CustomerTransactions::where('customer_id',$id)->update([
          'full_contact' => $request->full_contact,
          'total_pay' => $request->total_pay,
          'due_to_admin' => $request->due_to_admin,
          'date' => $request->date,
          'updated_at' => Carbon::now(),
        ]);

        Session::flash('success_save_change','value');
        return redirect()->back();

    }

    /* ****** ========= Payment ========= ****** */
    public function payment($id){
      $transaction = CustomerTransactions::where('cust_trans_id',$id)->first();
      return view('admin.customer_transaction.payment.index',compact('transaction'));
    }

    public function paymentSubmit(Request $request, $id){
      /* ===================== Payment Submit ===================== */
      dd($request->all());
      $transaction = CustomerTransactions::where('cust_trans_id',$id)->update([

      ]);
      /* ===================== Payment Submit ===================== */
    }


}
