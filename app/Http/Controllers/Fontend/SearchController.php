<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller{
    // ====================== Do Work ========================
    public function searchProduct(Request $request){
      // ============= do work ===================
      $request->validate([ 'search' => 'required' ]);
      $search = $request->search;

      $products = Product::where("product_name","LIKE","%".$request->search."%")
                         ->orWhere('product_code',"LIKE","%".$request->search."%")
                         ->orWhere('product_qty',"LIKE","%".$request->search."%")
                         ->orWhere('product_tags',"LIKE","%".$request->search."%")
                         ->orWhere('product_size',"LIKE","%".$request->search."%")
                         ->orWhere('product_color',"LIKE","%".$request->search."%")
                         ->orWhere('selling_price',"LIKE","%".$request->search."%")
                         ->orWhere('discount_price',"LIKE","%".$request->search."%")
                         ->orWhere('short_descp',"LIKE","%".$request->search."%")
                         ->orWhere('long_descp',"LIKE","%".$request->search."%")
                         ->paginate(15);

      $count = Product::where("product_name","LIKE","%".$request->search."%")
                         ->orWhere('product_code',"LIKE","%".$request->search."%")
                         ->orWhere('product_qty',"LIKE","%".$request->search."%")
                         ->orWhere('product_tags',"LIKE","%".$request->search."%")
                         ->orWhere('product_size',"LIKE","%".$request->search."%")
                         ->orWhere('product_color',"LIKE","%".$request->search."%")
                         ->orWhere('selling_price',"LIKE","%".$request->search."%")
                         ->orWhere('discount_price',"LIKE","%".$request->search."%")
                         ->orWhere('short_descp',"LIKE","%".$request->search."%")
                         ->orWhere('long_descp',"LIKE","%".$request->search."%")
                         ->count();

      return view('fontend.search-result',compact('products','count','search'));
      // ============= do work ===================
    }

    public function findProducts(Request $request){
      // ============= do work ===================
      $request->validate([
            'search' => 'required'
        ]);

        $products = Product::where("product_name","LIKE","%".$request->search."%")
                           ->orWhere('product_code',"LIKE","%".$request->search."%")
                           ->orWhere('product_qty',"LIKE","%".$request->search."%")
                           ->orWhere('product_tags',"LIKE","%".$request->search."%")
                           ->orWhere('product_size',"LIKE","%".$request->search."%")
                           ->orWhere('product_color',"LIKE","%".$request->search."%")
                           ->orWhere('selling_price',"LIKE","%".$request->search."%")
                           ->orWhere('discount_price',"LIKE","%".$request->search."%")
                           ->orWhere('short_descp',"LIKE","%".$request->search."%")
                           ->orWhere('long_descp',"LIKE","%".$request->search."%")
                           ->get();
        return view('fontend.show-product',compact('products'));
      // ============= do work ===================
    }


}
