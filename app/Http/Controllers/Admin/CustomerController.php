<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EmployeeController;
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
      return $data = Customer::orderBy('customer_id','DESC')->get();
    }

    public function findCustomer($id){
      return $data = Customer::where('customer_id',$id)->first();
    }

    public function getSome(){
      return $data = Customer::orderBy('customer_id','DESC')->select(
        'customer_id',
        'customer_id_number',
        'customer_name',
        'customer_phone',
        'apply_date',
        'customer_photo',
        )->get();
    }

    public function getEmployee(){
      $employee = new EmployeeController();
      return $employee->getTwo();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $customers = $this->getSome();
        return view('admin.customer.index',compact('customers'));
    }

    public function create()
    {
        $employee = $this->getEmployee();
        $lastId = Customer::count();
        $customerIdNo = '10'.$lastId;
        return view('admin.customer.create',compact('lastId','customerIdNo','employee'));
    }

    public function store(Request $request){
      /* =================== form validation =================== */
      $request->validate([
        'customer_name' => 'required|min:3|max:50',
        'customer_father' => 'required|min:3|max:50',
        'customer_phone' => 'required|unique:customers,customer_phone',
        'customer_address' => 'required',
        'total_cost' => 'required',
        'payment' => 'required',
        'due' => 'required',
        'apply_date' => 'required',
        'employee_id' => 'required',
      ]);

      // $duration = Carbon::parse( $request->from_date )->diffInDays( $request->to_date );
      // $data['visa_duration'] = $duration;

      $customer_photo = '';
      if($request->file('customer_photo')){
        /* ========= make Image ========= */
        $image = $request->file('customer_photo');
        $imageName = 'image'.'-'.$request->customer_id_number.'-'.$image->getClientOriginalExtension();
        Image::make($image)->resize(150,150)->save('uploads/customers/'.$imageName);
        $customer_photo = 'uploads/customers/'.$imageName;
        /* ========= make Image ========= */
      }
      $insert = Customer::insertGetId([
        'customer_id_number' => $request->customer_id_number,
        'customer_name' => $request->customer_name,
        'customer_father' => $request->customer_father,
        'customer_phone' => $request->customer_phone,
        'customer_email' => $request->customer_email,
        'customer_address' => $request->customer_address,
        'customer_photo' => $customer_photo,
        'total_cost' => $request->total_cost,
        'payment' => $request->payment,
        'due' => $request->due,
        'employee_id' => $request->employee_id,
        'apply_date' => $request->apply_date,
        'customer_creator' => Auth::user()->id,
        'customer_slug' => strtolower(str_replace(' ','-',$request->customer_name)),
        'created_at' => Carbon::now(),
      ]);
      /* ============ Insert visa ============ */
      CustomerVisa::insert([
        'customer_id' => $insert,
        'created_at' => Carbon::now(),
      ]);
      /* ========= flash massege ========= */
      Session::flash('success_store_first_step','value');
      return redirect()->route('customer-visa.edit',$insert);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($customer_id)
    {
        $data = $this->findCustomer($customer_id);
        return view('admin.customer.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customer_id)
    {
        $data = $this->findCustomer($customer_id);
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
        $findCustomer = Customer::where('customer_id',$id)->first();
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

          $update = Customer::where('customer_id',$id)->update($data);
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

        $update = Customer::where('customer_id',$id)->update($data);

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
        $findCustomer = Customer::where('customer_id',$id)->first();
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
