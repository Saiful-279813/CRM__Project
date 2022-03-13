<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Carbon\Carbon;
use Session;
use Image;

class CategoryController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Category::get();
        return view('admin.category.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'category_name' => 'required|max:220|unique:categories,category_name'
        ]);
        // insert data in database
        if($request->file('image')){
          // make image
          $image = $request->file('image');
          $imageName = 'category-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(400,300)->save('uploads/category/'.$imageName);
          $saveUrl = 'uploads/category/'.$imageName;
          // make image
          $insert = Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
            'category_image' => $saveUrl,
            'user' => Auth::user()->id,
            'created_at' => Carbon::now(),
          ]);
        }else{
            // do work
            $insert = Category::insert([
              'category_name' => $request->category_name,
              'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
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
        $data = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        // dd($request->oldImage);
        // validation
        $id = $request->id;
        $this->validate($request,[
            'category_name' => 'required|max:220|unique:categories,category_name'.$id
        ]);
        // insert data in database
        if($request->file('image')){
          if($request->oldImage != ""){
            unlink($request->oldImage);
          }
          // make image
          $image = $request->file('image');
          $imageName = 'category-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(400,300)->save('uploads/category/'.$imageName);
          $saveUrl = 'uploads/category/'.$imageName;
          // make image
          $update = Category::where('id',$id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
            'category_image' => $saveUrl,
            'user' => Auth::user()->id,
            'updated_at' => Carbon::now(),
          ]);
        }else{
            // do work
            $update = Category::where('id',$id)->update([
              'category_name' => $request->category_name,
              'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
              'user' => Auth::user()->id,
              'updated_at' => Carbon::now(),
            ]);
            // do work
        }
        // redirect back
        Session::flash('success_update','value');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Category::where('id',$id)->delete();
        Session::flash('success_delete','value');
        return redirect()->route('brand.index');
    }
}
