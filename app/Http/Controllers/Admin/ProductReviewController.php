<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Carbon\Carbon;
use Session;

class ProductReviewController extends Controller{
    public function index(){
        $reviews = ProductReview::with('user','product')->latest()->get();
        return view('admin.review.create',compact('reviews'));
    }
    // =================== Approve ======================
    public function approve($id){
        ProductReview::where('id',$id)->update([
            'status' => 'approve',
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('approve_success','value');
        return Redirect()->back();
    }
    // =================== delete ======================
    public function delete($id){
        ProductReview::where('id',$id)->delete();
        Session::flash('delete_success','value');
        return Redirect()->back();
    }

}
