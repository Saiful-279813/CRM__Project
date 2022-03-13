

    // add to cart
    // public function addToCart(Request $request){
    //   // do work
    //   $product = Product::where('id',$request->id)->first();
    //
    //   $sell_price = ($product->selling_price - $product->discount_price);
    //
    //
    //   if(Auth::check()) {
    //     $insert = Cart::insert([
    //       'product_id' => $request->id,
    //       'price' => $sell_price,
    //       'discount' => $product->discount_price,
    //       'user_id' => Auth::user()->id,
    //       'created_at' => Carbon::now(),
    //     ]);
    //   }else{
    //     // do work
    //     if(Session::has('temp_user_id')){
    //         // do work
    //         $insert = Cart::insert([
    //           'product_id' => $request->id,
    //           'price' => $sell_price,
    //           'discount' => $product->discount_price,
    //           'temp_user_id' => session()->get('temp_user_id')['tempId'],
    //           'created_at' => Carbon::now(),
    //         ]);
    //         // do work
    //     }else{
    //       Session::put('temp_user_id',[ 'tempId' => bin2hex(random_bytes(10)) ]);
    //       // do work
    //       $insert = Cart::insert([
    //         'product_id' => $request->id,
    //         'temp_user_id' => session()->get('temp_user_id')['tempId'],
    //         'created_at' => Carbon::now(),
    //       ]);
    //       // do work
    //     }
    //     // do work
    //   }
    //   // response massege
    //   return response()->json(['success' => 'Sucessfully Added On Your Cart']);
    //   // do work
    // }
    // View to Mini Cart
    public function viewToMiniCart(){
      // do work
      if(Auth::check()) {
        $data = Cart::with('product')->where('user_id',Auth::user()->id)->get();
        $quantity = Cart::where('user_id',Auth::user()->id)->count();
      }else{
        $data = Cart::with('product')->where('temp_user_id',session()->get('temp_user_id')['tempId'])->get();
        $quantity = Cart::where('temp_user_id',session()->get('temp_user_id')['tempId'])->count();
      }

      return response()->json([
          'getData' => $data,
          'qty' => $quantity,
      ]);
      // do work
    }
    // View to Mini Cart
