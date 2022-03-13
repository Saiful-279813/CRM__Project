<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use PDF;

class OrderController extends Controller{
    public function newOrders(){
       $orders = Order::where('status','Pending')->orderBy('id','DESC')->get();
       return view('admin.orders.pending',compact('orders'));
    }

    public function confirmOrders(){
      $orders = Order::where('status','Confirm')->orderBy('id','DESC')->get();
      return view('admin.orders.confirm',compact('orders'));
    }

    public function saleOrders(){
      $orders = Order::where('status','Sale')->orderBy('id','DESC')->get();
      return view('admin.orders.sale',compact('orders'));
    }

    public function cencelOrder(){
      $orders = Order::where('status','Cencel')->orderBy('id','DESC')->get();
      return view('admin.orders.cencel',compact('orders'));
    }

    public function rejectOrders(){

    }

    // =============== Invoice Download ===============
    public function invoice($id){
      $order = Order::with('user')->where('user_id',Auth::user()->id)->where('id',$id)->first();
      $orderItems = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
      return view('admin.orders.invoice',compact('order','orderItems'));
    }

    // ================= Action ======================

    public function orderConfirm($id){
        Order::where('id',$id)->update([
            'status' => 'Confirm',
            'confirmed_date' => Carbon::now()
        ]);
        Session::flash('confirm_success','value');
        return Redirect()->back();
    }

    public function confirmToSale($id){
        Order::where('id',$id)->update([
            'status' => 'Sale',
            'confirmed_date' => Carbon::now()
        ]);
        Session::flash('sale_success','value');
        return Redirect()->back();
    }

    public function viewOrders($id){
      $order = Order::with('user')->where('id',$id)->first();
      $orderItems = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
      return view('admin.orders.view-order',compact('order','orderItems'));
    }

    public function pendingToCancel($id){
        Order::where('id',$id)->update([
            'status' => 'Cencel',
            'confirmed_date' => Carbon::now()
        ]);
        Session::flash('sale_success','value');
        return Redirect()->back();
    }
    // ================== End =====================
}
