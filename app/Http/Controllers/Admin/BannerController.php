<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $all = Banner::get();
      return view('admin.banner.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
      Image::make($image)->resize(2376,807)->save('uploads/banner/'.$imageName);
      $saveUrl = 'uploads/banner/'.$imageName;
      // make image
      $insert = Banner::insert([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $saveUrl,
        'user' => Auth::user()->id,
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
        $data = Banner::where('id',$id)->first();
        return view('admin.banner.edit',compact('data'));
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
          Image::make($image)->resize(2376,807)->save('uploads/banner/'.$imageName);
          $saveUrl = 'uploads/banner/'.$imageName;
          // make image
          $update = Banner::where('id',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $saveUrl,
            'user' => Auth::user()->id,
            'updated_at' => Carbon::now(),
          ]);
          // end update
        }else{
          $update = Banner::where('id',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'user' => Auth::user()->id,
            'updated_at' => Carbon::now(),
          ]);
        }

        // redirect back
        Session::flash('success_update','value');
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete = Banner::where('id',$id)->delete();
        Session::flash('success_delete','value');
        return redirect()->back();
    }
}
