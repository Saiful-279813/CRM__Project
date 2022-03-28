<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerVisa;
use Session;
use Auth;

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
        $data = $this->findData($id);
        return view('admin.customer_visa.edit',compact('data'));
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
    public function destroy($id)
    {
        //
    }
}
