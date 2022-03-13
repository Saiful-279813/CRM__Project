<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wislist;
use App\Models\Coupon;
use Carbon\Carbon;
use Cart;
use Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller{
    /*
    ========================================
    Add To Cart
    ========================================
    */
    public function addToCart(Request $request){
      $product = Product::where('id',$request->id)->first();

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        if ($product->discount_price == NULL) {
           Cart::add([
              'id' => $request->id,
              'name' => $product->product_name,
              'qty' => 1,
              'price' => $product->selling_price,
              'weight' => 1,
              'options' => [
                 'image' => $product->product_thambnail,
                ],
              ]);
             return response()->json(['success' => 'Sucessfully Added On Your Cart']);
        }else {
          Cart::add([
                'id' => $request->id,
                'name' => $product->product_name,
                'qty' => 1,
                'price' => ($product->selling_price - $product->discount_price),
                'weight' => 1,
                'options' => [
                  'image' => $product->product_thambnail,
                  'color' => $request->color,
                  'size' => $request->size,
                  ],
                ]);
                return response()->json(['success' => 'Sucessfully Added On Your Cart']);
        }

    }

    public function viewToMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }
    // minicart remove
    public function removeToMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Mini Cart']);
    }
    // Main Cart remove
    public function removeMainCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);
    }
    // ------------------------------------ main cart view
    public function viewToMainCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }

    // ------------------------------------ increment cart ------------------------------------
    public function incrementCart($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        return response()->json('increment');
    }
    // ------------------------------------ decrement cart ------------------------------------
    public function decrementCart($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json('decrement');
    }

    // ------------------------------------ Coupon Apply ------------------------------------
    public function couponApply(Request $request){
      // do work
      $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Success'
            ));
        }else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
      // do work
    }

    // =================== Coupon Calculation =====================
    public function couponCalculation(){
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    // ================= Coupon Remove =====================
    public function removeCoupon(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Success']);
    }

    // ================== Add To Wislist ======================
    public function addToWishlist(Request $request){
       if (Auth::check()) {
            $exists = Wislist::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();
            if (!$exists) {
                Wislist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'created_at' => Carbon::now(),
                ]);
                $count = Wislist::count();
                return response()->json([
                  'success' => 'Sucessfully Added On Your Wishlist',
                  'count' => $count,
                ]);
            }else {
                return response()->json(['error' => 'The Product Has Already On Your Wishlist']);
            }

        }else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
    }


}
