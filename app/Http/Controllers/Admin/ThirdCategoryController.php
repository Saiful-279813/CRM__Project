<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\ThirdCategory;
use Carbon\Carbon;
use Session;

class ThirdCategoryController extends Controller{
     // ajax method
      public function getThirdcategory($subcategory_id){
        $data = ThirdCategory::where('subcategory_id',$subcategory_id)->get();
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
          $all = ThirdCategory::with('category','subcategory')->orderBy('id','DESC')->get();
          return view('admin.thirdcategory.index',compact('all'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
      {
          $category = Category::where('id','!=',1)->get();
          return view('admin.thirdcategory.create',compact('category'));
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
              'subcategory_id' => 'required',
              'thirdcategory_name' => 'required|max:220'
          ]);
          // do work
          $insert = ThirdCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'thirdcategory_name' => $request->thirdcategory_name,
            'thirdcategory_slug' => strtolower(str_replace(' ','-',$request->thirdcategory_name)),
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
          $data = ThirdCategory::where('id',$id)->first();
          return view('admin.thirdcategory.edit',compact('data','category'));
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
          $this->validate($request,[
              'category_id' => 'required',
              'subcategory_id' => 'required',
              'thirdcategory_name' => 'required|max:220'
          ]);
          // do work
          $update = ThirdCategory::where('id',$request->id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'thirdcategory_name' => $request->thirdcategory_name,
            'thirdcategory_slug' => strtolower(str_replace(' ','-',$request->thirdcategory_name)),
            'user' => Auth::user()->id,
            'updated_at' => Carbon::now(),
          ]);
          // redirect back
          Session::flash('success_update','value');
          return redirect()->route('thirdcategory.index');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy($id)
      {
          $delete = ThirdCategory::where('id',$id)->delete();
          Session::flash('success_delete','value');
          return redirect()->back();
      }
     // ----------------- end class braket ------------
}
