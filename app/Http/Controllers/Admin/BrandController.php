<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use Image;



class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Brand::get();
        return view('admin.brand.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'brand_name' => 'required|max:220|unique:brands,brand_name'
        ]);
        // insert data in database
        if($request->file('image')){
          // make image
          $image = $request->file('image');
          $imageName = 'brand-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(400,300)->save('uploads/brand/'.$imageName);
          $saveUrl = 'uploads/brand/'.$imageName;
          // make image
          $insert = Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ','-',$request->brand_name)),
            'brand_image' => $saveUrl,
            'user' => Auth::user()->id,
            'created_at' => Carbon::now(),
          ]);
        }else{
            // do work
            $insert = Brand::insert([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ','-',$request->brand_name)),
                'user' => Auth::user()->id,
                'created_at' => Carbon::now(),
              ]);
            // do work
        }
        // redirect back
        Session::flash('success_store','value');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Brand::where('id',$id)->first();
        return view('admin.brand.edit',compact('data'));
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
        $this->validate($request,[
            'brand_name' => 'required|max:220|unique:brands,brand_name'.$id
        ]);
        // insert data in database
        if($request->file('image')){
          if($request->oldImage != ""){
            unlink($request->oldImage);
          }
          // make image
          $image = $request->file('image');
          $imageName = 'brand-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(400,300)->save('uploads/brand/'.$imageName);
          $saveUrl = 'uploads/brand/'.$imageName;
          // make image
          $update = Brand::where('id',$id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ','-',$request->brand_name)),
            'brand_image' => $saveUrl,
            'user' => Auth::user()->id,
            'created_at' => Carbon::now(),
          ]);
        }else{
            // do work
            $update = Brand::where('id',$id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ','-',$request->brand_name)),
                'user' => Auth::user()->id,
                'created_at' => Carbon::now(),
              ]);
            // do work
        }
        // redirect back
        Session::flash('success_update','value');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Brand::where('id',$id)->delete();
        Session::flash('success_delete','value');
        return redirect()->route('brand.index');
    }
}
