<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Requests\CustomerRequest;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\VisaTypeController;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerTransactions;
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

    public function country(){
      $countryOBJ = new CountryController();
      return $country = $countryOBJ->getSomeAll();
    }

    public function visaType(){
      $visaType = new VisaTypeController();
      return $visaType = $visaType->getSomeAll();
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
        $country = $this->country();
        $visaType = $this->visaType();
        return view('admin.customer.create',compact('lastId','customerIdNo','employee','country','visaType'));
    }

    public function store(Request $request){

      /* =================== form validation =================== */
      $request->validate([
        'customer_name' => 'required|min:3|max:50',
        'customer_father' => 'required|min:3|max:50',
        'visa_name' => 'required|min:3|max:50',
        'visa_remarks' => 'required|min:3|max:250',
        'pp_location' => 'required|min:3|max:250',
        'customer_phone' => 'required|unique:customers,customer_phone',
        'visa_number' => 'required|unique:customers,visa_number',
        'passport_number' => 'required|unique:customers,passport_number',
        'customer_address' => 'required',
        'apply_date' => 'required',
        'employee_id' => 'required',
        'place_country_id' => 'required',
        'visa_type_id' => 'required',
        'from_date' => 'required',
        'to_date' => 'required',
        'vecxin' => 'required',
        'PC' => 'required',
        'medical' => 'required',
        'madical_date' => 'required',
        'report' => 'required',
        'visa_online' => 'required',
        'visa' => 'required',
        'training' => 'required',
        'manpower' => 'required',
        'ticket' => 'required',
        'work' => 'required',
      ]);

      /* ========== Insert Data In Database ========== */
      $insert = Customer::insertGetId([
        'customer_id_number' => $request->customer_id_number,
        'customer_name' => $request->customer_name,
        'customer_father' => $request->customer_father,
        'customer_phone' => $request->customer_phone,
        'customer_email' => $request->customer_email,
        'customer_address' => $request->customer_address,
        /* ========== Visa Information ========== */
        'visa_name' => $request->visa_name,
        'visa_remarks' => $request->visa_remarks,
        'visa_number' => $request->visa_number,
        'passport_number' => $request->passport_number,
        'pp_location' => $request->pp_location,
        'vecxin' => $request->vecxin,
        'PC' => $request->PC,
        'medical' => $request->medical,
        'madical_date' => $request->madical_date,
        'report' => $request->report,
        'visa_online' => $request->visa_online,
        'visa' => $request->visa,
        'visa_duration' => Carbon::parse( $request->from_date )->diffInDays( $request->to_date ),
        'training' => $request->training,
        'manpower' => $request->manpower,
        'ticket' => $request->ticket,
        'work' => $request->work,
        'from_date' => $request->from_date,
        'to_date' => $request->to_date,
        'place_country_id' => $request->place_country_id,
        'visa_type_id' => $request->visa_type_id,
        'employee_id' => $request->employee_id,
        /* ========== Visa Information ========== */

        'apply_date' => $request->apply_date,
        'customer_creator' => Auth::user()->id,
        'customer_slug' => strtolower(str_replace(' ','-',$request->customer_name)),
        'created_at' => Carbon::now(),
      ]);
      /* ========== Insert Data In Database ========== */
      if($request->file('customer_photo')){
        /* ========= make Image ========= */
        $image = $request->file('customer_photo');
        $imageName = 'image'.'-'.$insert.'-'.$image->getClientOriginalExtension();
        Image::make($image)->resize(150,150)->save('uploads/customers/'.$imageName);
        $customer_photo = 'uploads/customers/'.$imageName;
        /* ========= make Image ========= */
        Customer::where('customer_id',$insert)->update([
          'customer_photo' => $customer_photo,
          'updated_at' => Carbon::now(),
        ]);

      }

      if($request->file('visa_image')){
        $image = $request->file('visa_image');
        $imageName = 'visa'.'-'.$insert.'-'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/customers/visa/'.$imageName);
        $visa_image = 'uploads/customers/visa/'.$imageName;
        /* ========= make Image ========= */
        Customer::where('customer_id',$insert)->update([
          'visa_image' => $visa_image,
          'updated_at' => Carbon::now(),
        ]);
      }

      if($request->file('passport_image')){
        $image = $request->file('passport_image');
        $imageName = 'passport'.'-'.$insert.'-'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/customers/passport/'.$imageName);
        $passport_image = 'uploads/customers/passport/'.$imageName;
        /* ========= make Image ========= */
        Customer::where('customer_id',$insert)->update([
          'passport_image' => $passport_image,
          'updated_at' => Carbon::now(),
        ]);
      }

      /* ============ Insert visa ============ */
      CustomerTransactions::insert([
        'customer_id' => $insert,
        'created_at' => Carbon::now(),
      ]);
      /* ========= flash massege ========= */

      Session::flash('success_store_first_step','value');
      return redirect()->route('customer-transaction.edit',$insert);
    }

    public function show($customer_id)
    {
        $data = $this->findCustomer($customer_id);
        return view('admin.customer.view',compact('data'));
    }

    public function edit($customer_id)
    {
        $data = $this->findCustomer($customer_id);
        return view('admin.customer.edit',compact('data'));
    }

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

    /* ===========  */
    public function customerListDownload(){
      $customer_list = Customer::leftjoin('customer_transactions','customers.customer_id','=','customer_transactions.customer_id')->get();
      return view('admin.download.customer.list',compact('customer_list'));
    }



}
