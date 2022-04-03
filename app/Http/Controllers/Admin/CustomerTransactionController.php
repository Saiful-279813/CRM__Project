<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerTransactions;
use App\Models\CustomerPayment;
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
          'officer_commision' => $request->officer_commision,
          'agent_commision' => $request->agent_commision,
          'cost' => $request->cost,
          'payment_to_admin' => $request->payment_to_admin,
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
      $calculate = CustomerTransactions::where('cust_trans_id',$id)->first();
      $total_pay = ($request->total_pay + $calculate->total_pay);
      $due = ($calculate->due_to_admin - $request->total_pay);


      if($calculate->due_to_admin != 0){
        $transaction = CustomerTransactions::where('cust_trans_id',$id)->update([
          'total_pay' => $total_pay,
          'due_to_admin' => $due,
        ]);
      }else{
        Session::flash('due_amount_0','value');
        return redirect()->back();
      }

      CustomerPayment::insert([
        'customer_id' => $id,
        'amount' => $request->total_pay,
        'remarks' => $request->remarks,
        'created_at' => Carbon::now(),
      ]);

      Session::flash('success_store','value');
      return redirect()->back();

      /* ===================== Payment Submit ===================== */
    }


}
