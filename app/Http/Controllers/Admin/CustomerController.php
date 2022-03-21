<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerVisa;
use Carbon\Carbon;
use Session;
use Auth;
use Image;

class CustomerController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = Customer::orderBy('id','DESC')->get();
    }



    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $customers = $this->getAll();
        return view('admin.customer.index',compact('customers'));
    }

    public function create()
    {
        $lastId = Customer::count();
        $customerIdNo = '10'.$lastId;
        return view('admin.customer.create',compact('lastId','customerIdNo'));
    }

    public function store(Request $request)
    {
        /* From validation */
        $request->validate([
          'customer_name' => 'required',
          'customer_father' => 'required',
          'customer_phone' => 'required',
          'customer_address' => 'required',
          'total_cost' => 'required',
          'payment' => 'required',
          'apply_date' => 'required',
          'customer_photo' => 'required',
          /* Visa Infomartion */
          'visa_number' => 'required|unique:customer_visas|max:60' 
        ]);

        /* Insert data in database */
        $insert = Customer::insertGetId([
          'customer_id_number' => $request->customer_id_number,
          'customer_name' => $request->customer_name,
          'customer_father' => $request->customer_father,
          'customer_phone' => $request->customer_phone,
          'customer_address' => $request->customer_address,
          'total_cost' => $request->total_cost,
          'payment' => $request->payment,
          'due' => $request->due,
          'apply_date' => $request->apply_date,
          'customer_creator' => Auth::user()->id,
          'customer_slug' => strtolower(str_replace(' ','-',$request->customer_name)),
          'created_at' => Carbon::now(),
        ]);
        /* image upload */
        if($request->file('customer_photo')){
          /* ==== make image ==== */
          $image = $request->file('customer_photo');
          $imageName = 'customer-image'.'-'.$insert.'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(150,150)->save('uploads/customers/'.$imageName);
          $saveUrl = 'uploads/customers/'.$imageName;
          /* ==== make image ==== */
          $image_upload = Customer::where('id',$insert)->update([
            'customer_photo' => $saveUrl,
            'updated_at' => Carbon::now(),
          ]);

        }
        /* =================== Insert data in customer visa =================== */
        $customerVisa = CustomerVisa::insertGetId([
          'customer_id' => $insert,
          'visa_number' => $request->visa_number,
          'passport_number' => $request->passport_number,
          'passport_number' => $request->passport_number,
          'from_date' => $request->from_date,
          'to_date' => $request->to_date,
          'visa_duration' => 30,
          'place_of_issue' => $request->place_of_issue,
          'visa_type' => $request->visa_type,
          'visa_name' => $request->visa_name,
          'visa_remarks' => $request->visa_remarks,
        ]);

        /* image upload */
        if($request->file('visa_image')){
          /* ==== make image ==== */
          $image = $request->file('visa_image');
          $imageName = 'visa-image'.'-'.$customerVisa.'-'.$image->getClientOriginalExtension();
          Image::make($image)->save('uploads/customers/visa/'.$imageName);
          $saveUrl = 'uploads/customers/visa/'.$imageName;
          /* ==== make image ==== */
          CustomerVisa::where('id',$customerVisa)->update([
            'visa_image' => $saveUrl,
            'updated_at' => Carbon::now(),
          ]);

        }

        /* image upload */
        if($request->file('passport_image')){
          /* ==== make image ==== */
          $image = $request->file('passport_image');
          $imageName = 'passport-image'.'-'.$customerVisa.'-'.$image->getClientOriginalExtension();
          Image::make($image)->save('uploads/customers/passport/'.$imageName);
          $saveUrl = 'uploads/customers/passport/'.$imageName;
          /* ==== make image ==== */
          CustomerVisa::where('id',$customerVisa)->update([
            'passport_image' => $saveUrl,
            'updated_at' => Carbon::now(),
          ]);

        }

        Session::flash('store_success','value');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
