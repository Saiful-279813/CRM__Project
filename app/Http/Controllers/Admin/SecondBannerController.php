<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecondBanner;
use Carbon\Carbon;
use Session;
use Image;

class SecondBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $all = SecondBanner::get();
      return view('admin.secondbanner.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.secondbanner.create');
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
        $imageName = 'banner-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('uploads/secondbanner/'.$imageName);
        $saveUrl = 'uploads/secondbanner/'.$imageName;
        // make image
        $insert = SecondBanner::insert([
          'title' => $request->title,
          'image_path' => $saveUrl,
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
        $data = SecondBanner::where('id',$id)->first();
        return view('admin.secondbanner.edit',compact('data'));
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
        // make image
        if($request->file('image')){
          if($request->oldImage != ""){
            unlink($request->oldImage);
          }
          // make image
          $image = $request->file('image');
          $imageName = 'banner-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(768,450)->save('uploads/secondbanner/'.$imageName);
          $saveUrl = 'uploads/secondbanner/'.$imageName;
          // make image
          $update = SecondBanner::where('id',$id)->update([
            'title' => $request->title,
            'image_path' => $saveUrl,
            'updated_at' => Carbon::now(),
          ]);
          // end update
        }else{
          $update = SecondBanner::where('id',$id)->update([
            'title' => $request->title,
            'updated_at' => Carbon::now(),
          ]);
        }

        // redirect back
        Session::flash('success_update','value');
        return redirect()->route('secondbanner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = SecondBanner::where('id',$id)->first();
        if($data->image_path != NULL){
          unlink($data->image_path);
        }
        $delete = SecondBanner::where('id',$id)->delete();
        Session::flash('success_delete','value');
        return redirect()->back();
    }
}
