<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\CustomerPayment;

class SearchController extends Controller
{
    // =============== for Customer ===============
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
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);



      }
    }

    // =============== for Employee ===============

    public function employee(Request $request){
      $data = $request->employee;
      $employee = Employee::where("ID_Number","LIKE","%".$data."%")
                            ->orWhere('mobile_no',"LIKE","%".$data."%")
                            ->orWhere('nid',"LIKE","%".$data."%")
                            ->first();

      if($employee){
        return redirect()->route('employee.show',$employee->employee_id);
      }else{

        $notification=array(
            'message'=>'Employee Not Found!',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);


      }

    }


    


}
