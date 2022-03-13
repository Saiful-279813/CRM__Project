<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Carbon\Carbon;
use Session;
use Auth;

class ReviewController extends Controller
{
    public function index($id){
        return view('customer.review',compact('id'));
    }

    public function reviewSubmit(Request $request){
      // do work
      $request->validate([
          'rating' => 'required',
          'comment' => 'required',
      ]);


      ProductReview::insert([
          'user_id' => Auth::id(),
          'product_id' => $request->product_id,
          'comment' => $request->comment,
          'rating' => $request->rating,
          'created_at' => Carbon::now(),
      ]);

      $notification=array(
          'message'=>'Review Done',
          'alert-type'=>'success'
      );
      return Redirect()->back()->with($notification);
      // do work
    }

}
