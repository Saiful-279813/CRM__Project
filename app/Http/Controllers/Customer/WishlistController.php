<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wislist;
use Auth;

class WishlistController extends Controller
{
    public function index(){
      return view('fontend.wishlist');
    }

    public function getWishList(){
        $wishlist = Wislist::with('product')->where('user_id',Auth::id())->latest()->get();
        $count = Wislist::where('user_id',Auth::id())->count();
        return response()->json([
          'data' => $wishlist,
          'count' => $count,
        ]);
    }

    public function removeWishList($id){
      Wislist::where('user_id',Auth::id())->where('id',$id)->delete();
      return response()->json(['success' => 'Sucessfully Product Remove']);
    }

}
