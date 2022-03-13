<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Session;

class SubCategoryController extends Controller{
      // ajax method
      public function getSubcategory($category_id){
        $data = SubCategory::with('category')->where('category_id',$category_id)->get();
        return json_encode($data);
      }
      // ajax method
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
      */
      public function index()
      {
          $all = SubCategory::with('category')->orderBy('id','DESC')->get();
          return view('admin.subcategory.index',compact('all'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
          $category = Category::where('id','!=',1)->get();
          return view('admin.subcategory.create',compact('category'));
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
              'category_id' => 'required',
              'subcategory_name' => 'required|max:220'
          ]);
          // do work
          $insert = SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
            'user' => Auth::user()->id,
            'created_at' => Carbon::now(),
          ]);
          // do work
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
          $category = Category::where('id','!=',1)->get();
          $data = SubCategory::where('id',$id)->first();
          return view('admin.subcategory.edit',compact('data','category'));
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
          // validation
          $id = $request->id;
          $this->validate($request,[
              'category_id' => 'required',
              'subcategory_name' => 'required|max:220'
          ]);
          // insert data in database
          $update = SubCategory::where('id',$id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
            'user' => Auth::user()->id,
            'created_at' => Carbon::now(),
          ]);
          // redirect back
          Session::flash('success_update','value');
          return redirect()->route('subcategory.index');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
          $delete = SubCategory::where('id',$id)->delete();
          Session::flash('success_delete','value');
          return redirect()->route('subcategory.index');
      }
    // ----------------- end class braket ------------
}
