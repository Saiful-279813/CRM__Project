<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\VisaTypeController;
use Illuminate\Http\Request;
use App\Models\CustomerVisa;
use Carbon\Carbon;
use Session;
use Auth;
use Image;

class CustomerVisaController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = CustomerVisa::orderBy('customer_visa_id','DESC')->get();
    }

    public function getSomeAll(){
        return $data = CustomerVisa::leftjoin('countries','customer_visas.place_country_id','=','countries.country_id')
                               ->leftjoin('visa_types','customer_visas.visa_type_id','=','visa_types.visa_type_id')
                               ->select(
                                 'countries.name as countryName',
                                 'visa_types.visa_type_name as visaTypeName',
                                 /* Employee Table end */
                                 'customer_visas.visa_number',
                                 'customer_visas.passport_number',
                                 'customer_visas.visa_duration',
                                 'customer_visas.visa_name',
                                 'customer_visas.visa_image',
                                 'customer_visas.customer_visa_id',
                                 'customer_visas.customer_id',
                                 )->get();
    }

    public function findData($id){
      return $data = CustomerVisa::where('customer_visa_id',$id)->first();
    }

    public function country(){
      $countryOBJ = new CountryController();
      return $country = $countryOBJ->getSomeAll();
    }

    public function visaType(){
      $visaType = new VisaTypeController();
      return $visaType = $visaType->getSomeAll();
    }

    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $visa = $this->getSomeAll();
        return view('admin.customer_visa.index',compact('visa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function edit($id)
    {
        $country = $this->country();
        $visaType = $this->visaType();
        $data = $this->findData($id);
        return view('admin.customer_visa.edit',compact('data','country','visaType'));
    }

    public function updated(Request $request, $id)
    {
        /* ========== Form Validation ========== */
        $findData = CustomerVisa::where('customer_visa_id',$id)->first();

        if($findData->visa_number == NULL){
          $request->validate([
            'visa_number' => 'required|min:3|max:50|unique:customer_visas,visa_number',
          ]);
        }

        if($findData->passport_number == NULL){
          $request->validate([
            'passport_number' => 'required|min:3|max:50|unique:customer_visas,passport_number',
          ]);
        }

        $request->validate([
          'visa_number' => 'required|min:3|max:50|unique:customer_visas,visa_number,'.$findData->customer_visa_id,
          'passport_number' => 'required|min:3|max:50|unique:customer_visas,passport_number',
          'place_country_id' => 'required',
          'visa_type_id' => 'required',
          'visa_name' => 'required',
          'medical' => 'required',
          'report' => 'required',
          'madical_date' => 'required',
          'from_date' => 'required',
          'to_date' => 'required',
          'visa_remarks' => 'required',
        ]);


        // dd($findData->customer_visa_id);

        // if($findData->visa_number !=NULL){
        //   $request->validate([
        //       'visa_number' => 'required|min:3|max:50|unique:customer_visas,visa_number,'.$findData->customer_visa_id,
        //       'passport_number' => 'required|min:3|max:50|unique:customer_visas,passport_number,'.$findData->customer_visa_id,
        //   ]);
        // }



        // if($findData->visa_number == NULL){
        //   /* ============== Work ============== */
        //
        //   /* ============== Work ============== */
        // }else{
        //   /* ============== Work ============== */
        //   $request->validate([
        //     // 'visa_number' => 'required|min:3|max:50|unique:customer_visas,visa_number,'.$id,
        //     // 'passport_number' => 'required|min:3|max:50|unique:customer_visas,passport_number,'.$id,
        //
        //     'visa_number' => 'required|min:3|max:50',
        //     'passport_number' => 'required|min:3|max:50',
        //     'place_country_id' => 'required',
        //     'visa_type_id' => 'required',
        //     'visa_name' => 'required',
        //     'medical' => 'required',
        //     'report' => 'required',
        //     'madical_date' => 'required',
        //     'from_date' => 'required',
        //     'to_date' => 'required',
        //     'visa_remarks' => 'required',
        //   ]);
        //   /* ============== Work ============== */
        // }

        /* ========= make Image ========= */
        $visa_image = '';
        $passport_image = '';

        if($request->file('visa_image')){
          $image = $request->file('visa_image');
          $imageName = 'visa'.'-'.$id.'-'.$image->getClientOriginalExtension();
          Image::make($image)->save('uploads/customers/visa/'.$imageName);
          $visa_image = 'uploads/customers/visa/'.$imageName;
        }

        if($request->file('passport_image')){
          $image = $request->file('passport_image');
          $imageName = 'passport'.'-'.$id.'-'.$image->getClientOriginalExtension();
          Image::make($image)->save('uploads/customers/passport/'.$imageName);
          $passport_image = 'uploads/customers/passport/'.$imageName;
        }
        /* ========== Update Data in Database ========== */
        CustomerVisa::where('customer_visa_id',$id)->update([
          'visa_number' => $request->visa_number,
          'passport_number' => $request->passport_number,
          'place_country_id' => $request->place_country_id,
          'visa_type_id' => $request->visa_type_id,
          'visa_name' => $request->visa_name,
          'medical' => $request->medical,
          'report' => $request->report,
          'madical_date' => $request->madical_date,
          'from_date' => $request->from_date,
          'to_date' => $request->to_date,
          'vecxin' => $request->vecxin,
          'PC' => $request->PC,
          'training' => $request->training,
          'manpower' => $request->manpower,
          'ticket' => $request->ticket,
          'visa_name' => $request->visa_name,
          'visa_remarks' => $request->visa_remarks,
          'visa_image' => $visa_image,
          'passport_image' => $passport_image,
          'updated_at' => Carbon::now(),
        ]);
        /* ========= flash massege ========= */
        Session::flash('success_update','value');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
