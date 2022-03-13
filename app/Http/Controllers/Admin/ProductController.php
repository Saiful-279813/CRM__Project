<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Session;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('id','DESC')->paginate(70);
        return view('admin.product.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();
        $code = 'SWQ'.mt_rand(1000000, 9999999).Product::count();

        return view('admin.product.create',compact('brand','category','code'));
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
        // $this->validate($request,[
        //   'category_id' => 'required',
        //   'product_name' => 'required',
        //   'product_code' => 'required',
        //   'product_qty' => 'required',
        //   'product_tags' => 'required',
        //   'selling_price' => 'required',
        //   'product_thambnail' => 'required',
        // ]);
        // make Image
        $image = $request->file('product_thambnail');
        $imageName = 'product-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1100,1100)->save('uploads/product/'.$imageName);
        $saveUrl = 'uploads/product/'.$imageName;

        $store = Product::insertGetId([
          'user_id' => Auth::user()->id,
          'brand_id' => $request->brand_id,
          'category_id' => $request->category_id,
          'subcategory_id' => $request->subcategory_id,
          'thirdcategory_id' => $request->thirdcategory_id,
          'product_name' => $request->product_name,
          'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
          'product_code' => $request->product_code,
          'product_qty' => $request->product_qty,
          'product_tags' => $request->product_tags,
          'product_size' => $request->product_size,
          'product_color' => $request->product_color,
          'selling_price' => $request->selling_price,
          'discount_price' => $request->discount_price,
          'tax' => $request->tax,
          'short_descp' => $request->short_descp,
          'long_descp' => $request->long_descp,
          'product_thambnail' => $saveUrl,
          'hot_deals' => $request->hot_deals,
          'featured' => $request->featured,
          'special_offer' => $request->special_offer,
          'special_deals' => $request->special_deals,
          'created_at' => Carbon::now(),
        ]);


          //////////////////// Multiple image uplod start /////////////////////////////////
          $multipleImage = $request->file('multi_img');
          foreach ($multipleImage as $img) {
              // make image
              $imageName = 'product-multiple-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
              Image::make($image)->resize(1100,1100)->save('uploads/product/multiple/'.$imageName);
              $saveUrl = 'uploads/product/multiple/'.$imageName;
              // make image
              ProductImage::insert([
                  'product_id' => $store,
                  'photo_name' => $saveUrl,
                  'created_at' => Carbon::now(),
              ]);
           }
           //////////////////// Multiple image uplod End /////////////////////////////////

        Session::flash('success_store','value');
        return redirect()->back();

        /* =================== ))))))))))))))) +++++++++++++++ */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();
        $data = Product::where('id',$id)->first();
        return view('admin.product.edit',compact('brand','category','data'));
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
        // $this->validate($request,[
        //   'category_id' => 'required',
        //   'product_name' => 'required',
        //   'product_code' => 'required',
        //   'product_qty' => 'required',
        //   'product_tags' => 'required',
        //   'selling_price' => 'required',
        //   'product_thambnail' => 'required',
        // ]);
        // do work
        $update = Product::where('id',$id)->update([
          'user_id' => Auth::user()->id,
          'brand_id' => $request->brand_id,
          'category_id' => $request->category_id,
          'subcategory_id' => $request->subcategory_id,
          'thirdcategory_id' => $request->thirdcategory_id,
          'product_name' => $request->product_name,
          'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
          'product_code' => $request->product_code,
          'product_qty' => $request->product_qty,
          'product_tags' => $request->product_tags,
          'product_size' => $request->product_size,
          'product_color' => $request->product_color,
          'selling_price' => $request->selling_price,
          'discount_price' => $request->discount_price,
          'tax' => $request->tax,
          'short_descp' => $request->short_descp,
          'long_descp' => $request->long_descp,
          'hot_deals' => $request->hot_deals,
          'featured' => $request->featured,
          'special_offer' => $request->special_offer,
          'special_deals' => $request->special_deals,
          'updated_at' => Carbon::now(),
        ]);
        // do work
        Session::flash('success_update','value');
        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($id){
        $prodMain = Product::where('id',$id)->first();
        $prodMult = ProductImage::where('product_id',$id)->get();

        dd($prodMult);

        if($prodMain->product_thambnail != ""){
          unlink($prodMain->product_thambnail);
        }


        foreach ($prodMult as $mult) {
          if($mult->photo_name != ""){
            unlink($mult->photo_name);
          }
        }

        $delete = Product::where('id',$id)->delete();
        Session::flash('success_delete','value');
        return redirect()->back();
     }

}
