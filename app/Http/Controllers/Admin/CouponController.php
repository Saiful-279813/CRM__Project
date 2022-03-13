<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Coupon::get();
        return view('admin.coupon.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
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
            'coupon_name' => 'required|max:220|unique:coupons,coupon_name'
        ]);

        // dd($request->all());

        $data = $request->all();
        Coupon::create($data);
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
        $data = Coupon::where('id',$id)->first();
        return view('admin.coupon.edit',compact('data'));
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
            'coupon_name' => 'required|max:220|unique:coupons,coupon_name'.$id
        ]);

        Coupon::where('id',$id)->update([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'coupon_type' => $request->coupon_type,
        ]);
        // redirect back
        Session::flash('success_update','value');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Coupon::where('id',$id)->delete();
        // redirect back
        Session::flash('success_delete','value');
        return redirect()->back();
    }
}
