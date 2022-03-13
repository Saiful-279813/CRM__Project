<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Session;
use Image;
use Auth;


class CustomerController extends Controller
{
    public function index(){
      // order Query ==================
      $orders = Order::with('orderItem')->where('user_id',Auth::id())->select('id','order_number','order_date','status','amount')->orderBy('id','DESC')->get();
      // order Query ==================
      return view('customer.home',compact('orders'));
    }

    public function orderDetails($id){
        $order = Order::with('orderItem')->where('user_id',Auth::id())->where('id',$id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->get();
        return view('customer.orderDetails',compact('order','orderItem'));
    }

    // modify User Information
    public function AuthCustModify(Request $request){
        dd($request->all());
        // --------
        if($request->file('image')){
          // make image
          $image = $request->file('image');
          $imageName = 'user-image'.'-'.time().'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(400,350)->save('uploads/user/'.$imageName);
          $saveUrl = 'uploads/user/'.$imageName;
          // store data
          $modify = User::where('id',Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'upload_photo_path' => $saveUrl,
            'updated_at' => Carbon::now(),
          ]);
          // store data
        }else{
          // store data
          $modify = User::where('id',Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => Carbon::now(),
          ]);
          // store data
        }
        // --------
        Session::flash('success_store','value');
        return redirect()->back();
        // --------
    }
    // modify User Information

    public function ordertracking(Request $request){

        $order = Order::where('invoice_no',$request->invoice_no)->first();

        if($order){
          $order = Order::with('orderItem')->where('invoice_no',$request->invoice_no)->first();
          $orderItem = OrderItem::with('product')->where('order_id',$order->id)->get();
          return view('customer.orderDetails',compact('order','orderItem'));
        }else{
          // +++++++++++++ Redirect Back +++++++++++++
          $notification=array(
              'message'=>'Order Not Found!',
              'alert-type'=>'error'
          );
          return Redirect()->back()->with($notification);
        }
    }

}
