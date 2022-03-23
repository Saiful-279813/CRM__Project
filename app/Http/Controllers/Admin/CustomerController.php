<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use App\Models\Customer;
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

    public function findCustomer($id){
      return $data = Customer::where('id',$id)->first();
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

    public function store(Request $request){
      /* =================== form validation =================== */
      $request->validate([
        'customer_name' => 'required|min:3|max:50',
        'customer_father' => 'required|min:3|max:50',
        'customer_phone' => 'required|unique:customers,customer_phone',
        'visa_number' => 'required|unique:customers,visa_number',
        'passport_number' => 'required|unique:customers,passport_number',
        'customer_address' => 'required',
        'total_cost' => 'required',
        'payment' => 'required',
        'due' => 'required',
        'place_of_issue' => 'required',
        'visa_type' => 'required',
        'visa_name' => 'required',
        'visa_remarks' => 'required',
        'from_date' => 'required',
        'to_date' => 'required',
        'passport_image' => 'required',
        'visa_image' => 'required',
        'customer_photo' => 'required',
      ]);

      $duration = Carbon::parse( $request->from_date )->diffInDays( $request->to_date );

      $data =  $request->all();
      $data['customer_slug'] = strtolower(str_replace(' ','-',$request->customer_name));
      $data['customer_creator'] = Auth::user()->id;
      $data['visa_duration'] = $duration;
      $insert = Customer::create($data);

      if($request->file('customer_photo')){
        /* ========= make Image ========= */
        $image = $request->file('customer_photo');
        $imageName = 'image'.'-'.$insert->id.'-'.$image->getClientOriginalExtension();
        Image::make($image)->resize(150,150)->save('uploads/customers/'.$imageName);
        $saveUrl = 'uploads/customers/'.$imageName;

        Customer::where('id',$insert->id)->update([
          'customer_photo' => $saveUrl,
          'updated_at' => Carbon::now(),
        ]);
        /* ========= make Image ========= */
      }

      if($request->file('visa_image')){
        /* ========= make Image ========= */
        $image = $request->file('visa_image');
        $imageName = 'image'.'-'.$insert->id.'-'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/customers/visa/'.$imageName);
        $saveUrl = 'uploads/customers/visa/'.$imageName;

        Customer::where('id',$insert->id)->update([
          'visa_image' => $saveUrl,
          'updated_at' => Carbon::now(),
        ]);
        /* ========= make Image ========= */
      }

      if($request->file('passport_image')){
        /* ========= make Image ========= */
        $image = $request->file('passport_image');
        $imageName = 'image'.'-'.$insert->id.'-'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/customers/passport/'.$imageName);
        $saveUrl = 'uploads/customers/passport/'.$imageName;

        Customer::where('id',$insert->id)->update([
          'passport_image' => $saveUrl,
          'updated_at' => Carbon::now(),
        ]);
        /* ========= make Image ========= */
      }

      Session::flash('success_store','value');
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
        $data = $this->findCustomer($id);
        return view('admin.customer.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->findCustomer($id);
        return view('admin.customer.edit',compact('data'));
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
        /* =================== form validation =================== */
        $request->validate([
          'customer_name' => 'required|min:3|max:50',
          'customer_father' => 'required|min:3|max:50',
          'customer_phone' => 'required|unique:customers,customer_phone,'.$id,
          'visa_number' => 'required|unique:customers,visa_number,'.$id,
          'passport_number' => 'required|unique:customers,passport_number,'.$id,
          'customer_address' => 'required',
          'total_cost' => 'required',
          'payment' => 'required',
          'due' => 'required',
          'place_of_issue' => 'required',
          'visa_type' => 'required',
          'visa_name' => 'required',
          'visa_remarks' => 'required',
          'from_date' => 'required',
          'to_date' => 'required',
        ]);

        $duration = Carbon::parse( $request->from_date )->diffInDays( $request->to_date );

        $data =  $request->all();
        $data['customer_slug'] = strtolower(str_replace(' ','-',$request->customer_name));
        $data['customer_creator'] = Auth::user()->id;
        $data['visa_duration'] = $duration;
        $findCustomer = Customer::where('id',$id)->first();
        // dd($request->all());

        if($request->file('customer_photo')){
          if($findCustomer->customer_photo != ""){
            unlink($findCustomer->customer_photo);
          }
          /* ========= make Image ========= */
          $image = $request->file('customer_photo');
          $imageName = 'image'.'-'.$id.'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(150,150)->save('uploads/customers/'.$imageName);
          $saveUrl = 'uploads/customers/'.$imageName;
          $data['customer_photo'] = $saveUrl;

          $update = Customer::where('id',$id)->update($data);
          /* ========= make Image ========= */
        }

        if($request->file('visa_image')){
          if($findCustomer->visa_image != NULL){
            unlink($findCustomer->visa_image);
          }
          /* ========= make Image ========= */
          $image = $request->file('visa_image');
          $imageName = 'image'.'-'.$id.'-'.$image->getClientOriginalExtension();
          Image::make($image)->save('uploads/customers/visa/'.$imageName);
          $saveUrl = 'uploads/customers/visa/'.$imageName;
          $data['visa_image'] = $saveUrl;
          /* ========= make Image ========= */
        }

        if($request->file('passport_image')){
          if($findCustomer->passport_image != NULL){
            unlink($findCustomer->passport_image);
          }
          /* ========= make Image ========= */
          $image = $request->file('passport_image');
          $imageName = 'image'.'-'.$id.'-'.$image->getClientOriginalExtension();
          Image::make($image)->save('uploads/customers/passport/'.$imageName);
          $saveUrl = 'uploads/customers/passport/'.$imageName;

          $data['passport_image'] = $saveUrl;
          /* ========= make Image ========= */
        }

        $update = Customer::where('id',$id)->update($data);

        Session::flash('edit_success','value');
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $findCustomer = Customer::where('id',$id)->first();
        if($findCustomer->customer_photo != NULL){
          unlink($findCustomer->customer_photo);
        }
        if($findCustomer->visa_image != NULL){
          unlink($findCustomer->visa_image);
        }
        if($findCustomer->passport_image != NULL){
          unlink($findCustomer->passport_image);
        }
        $delete = Customer::where('id',$id)->delete();
        Session::flash('delete_success','value');
        return redirect()->route('customers.index');
    }
}
