<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerPayment;

class SearchController extends Controller
{
    public function customer(Request $request){
      $data = $request->customer;

      $customer = Customer::where("passport_number","LIKE","%".$data."%")
                            ->orWhere('customer_phone',"LIKE","%".$data."%")
                            ->orWhere('customer_id_number',"LIKE","%".$data."%")
                            ->first();

      if($customer){
        return redirect()->route('customers.show',$customer->customer_id);
      }else{
        // return "nai";
        $notification=array(
            'message'=>'Customer Not Found!',
            'alert-type'=>'danger'
        );
        return Redirect()->back()->with($notification);
      }

    }
}
