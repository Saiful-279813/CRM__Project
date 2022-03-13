<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cart;

class CheckoutController extends Controller
{
    public function orderStore(Request $request){

        if($request->payment_option == "cashOnDelivery"){
          /*
          =============== Do Work ============
          */
          if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
          }else {
            $total_amount = round(Cart::total());
          }

          $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'division' => $request->division,
                'district' => $request->district,
                'thana' => $request->thana,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'payment_type' => 'OCD',
                'payment_method' => 'Cash In Delivery',
                'transaction_id' => 'SWQ-'.uniqid(),
                'currency' => 'BDT',
                'amount' => $total_amount,
                'order_number' => 'ODN-'.uniqid(),
                'invoice_no' => 'SPM'.mt_rand(10000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
          ]);
          // product store
          $carts = Cart::content();
          foreach ($carts as $cart ) {
              OrderItem::insert([
                  'order_id' => $order_id,
                  'product_id' => $cart->id,
                  'qty' => $cart->qty,
                  'price' => $cart->price,
                  'created_at' => Carbon::now(),
              ]);
          }

          if (Session::has('coupon')) {
              Session::forget('coupon');
          }
          Cart::destroy();

          $notification=array(
              'message'=>'Your Order Place Success',
              'alert-type'=>'success'
          );
          return Redirect()->route('user.dashboard')->with($notification);
          /*
          =============== Do Work ============
          */
        }else{
          /*
          =============== Do Work ============
          */
          $data = array();
          $data['shipping_name'] = $request->name;
          $data['shipping_email'] = $request->email;
          $data['shipping_phone'] = $request->phone;
          $data['post_code'] = $request->post_code;
          $data['division'] = $request->division;
          $data['district'] = $request->district;
          $data['thana'] = $request->thana;
          $data['notes'] = $request->notes;
          $cartTotal = Cart::total();
          $carts = Cart::content();

          return view('fontend.payment.others',compact('data','cartTotal'));
          /*
          =============== Do Work ============
          */
        }




    }
}
