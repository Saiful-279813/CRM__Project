<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDelivery;
use Carbon\Carbon;
use Session;
use Image;

class ProductDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = ProductDelivery::orderBy('id','DESC')->get();
        return view('admin.product.delivery.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validate($request,[
            'image' => 'required'
        ]);
        // insert data in database
        // make image
        $image = $request->file('image');
        $imageName = 'delivery-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
        Image::make($image)->resize(50,50)->save('uploads/delivery/'.$imageName);
        $saveUrl = 'uploads/delivery/'.$imageName;
        // make image
        $insert = ProductDelivery::insert([
          'title' => $request->title,
          'content' => $request->content,
          'image' => $saveUrl,
          'created_at' => Carbon::now(),
        ]);
        // redirect back
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
        $data = ProductDelivery::where('id',$id)->first();
        return view('admin.product.delivery.edit',compact('data'));
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
        // validation
        // $this->validate($request,[
        //     'image' => 'required'
        // ]);

        if($request->file('image')){
          $data = ProductDelivery::where('id',$id)->first();
          if($data->image != ""){
            unlink($data->image);
          }
          // make image
          $image = $request->file('image');
          $imageName = 'delivery-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(50,50)->save('uploads/delivery/'.$imageName);
          $saveUrl = 'uploads/delivery/'.$imageName;
          // update
          $update = ProductDelivery::where('id',$id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $saveUrl,
            'updated_at' => Carbon::now(),
          ]);
        }else{
            $update = ProductDelivery::where('id',$id)->update([
              'title' => $request->title,
              'content' => $request->content,
              'updated_at' => Carbon::now(),
            ]);
        }

        // redirect back
        Session::flash('success_update','value');
        return redirect()->route('pdelivery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = ProductDelivery::where('id',$id)->first();
        if($data->image != NULL){
          unlink($data->image);
        }
        $delete = ProductDelivery::where('id',$id)->delete();
        Session::flash('success_delete','value');
        return redirect()->back();
    }
}
