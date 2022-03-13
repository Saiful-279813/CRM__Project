<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\OthersBanner;
use App\Models\ContactForm;
use App\Models\NewslatterEmail;
use App\Models\Brand;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Cart;

class FontendController extends Controller{
    //-------------------------- do work --------------------------
    public function index(){
      // specialOffer
      $specialOffer = Product::where('special_offer',1)->where('status',1)->get();

      $othersbanner = OthersBanner::where('id',1)->first();
      // category
      $category = Category::with('product')->orderBy('id','DESC')->get();
      // featured productChild
      $ftProduct = Product::where('featured',1)->where('status',1)->get();
      // Hot Deals
      $hotOffer = Product::where('hot_deals',1)->where('status',1)->orderBy('id','DESC')->limit(4)->get();
      // special offer
      $specialOffer = Product::where('special_offer',1)->where('status',1)->orderBy('id','DESC')->limit(4)->get();
      // special deals
      $specialDeals = Product::where('special_deals',1)->where('status',1)->orderBy('id','DESC')->limit(4)->get();
      // Recently add
      $recently = Product::where('status',1)->orderBy('id','DESC')->limit(4)->get();
      // featured productChild
      return view('fontend.index',compact('category','specialDeals','ftProduct','recently','hotOffer','specialOffer','othersbanner','specialOffer'));
    }

    // =================== Brand =====================
    public function brand(){
      $brands = Brand::with('product')->orderBy('id','DESC')->get();
      return view('fontend.brand',compact('brands'));
    }
    // =================== About =====================
    public function about(){
      return view('fontend.about');
    }

    // =================== Hot Deals =====================
    public function hotDeals(){
      $hotOffer = Product::where('hot_deals',1)->where('status',1)->orderBy('id','DESC')->paginate(15);
      $pcount = Product::where('hot_deals',1)->where('status',1)->count();
      $brand = Brand::orderBy('id','DESC')->get();
      $newProduct = Product::orderBy('id','DESC')->limit(4)->get();
      return view('fontend.hotDeals',compact('hotOffer','pcount','brand','newProduct'));
    }

    // =================== Contact =====================
    public function contact(){
      return view('fontend.contact');
    }

    public function contactInfoStore(Request $request){
        // ++++++++++ Validate ++++++++++
        $this->validate($request,[
          'name' => 'required|max:50',
          'email' => 'required|max:50',
          'telephone' => 'required|max:20',
          'subject' => 'required|max:220',
          'message' => 'required|max:230',
        ],[

        ]);
        $data = $request->all();
        ContactForm::create($data);
        // +++++++++++++ Redirect Back +++++++++++++
        $notification=array(
            'message'=>'Successfully Send Your Massege',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    // =================== newslatter data store =====================
    public function newslatterStore(Request $request){
        NewslatterEmail::create([
          'email' => $request->email,
          'created_at' => Carbon::now(),
        ]);
        return response()->json([ 'success' => 'Successfully Send Your Email' ]);
    }

    // -------------------  product quick view -------------------
    public function productQuickView(Request $request){
      $product = Product::with('brand','category')->where('id',$request->id)->first();
      return json_encode($product);
    }

    // -------------------  product details -------------------
    public function productDetails($id,$slug){
      $product = Product::where('id',$id)->first();
      //============== size ==============
      $size = $product->product_size;
      $product_size = explode(',',$size);
      //============== tags ==============
      $tag = $product->product_tags;
      $product_tag = explode(',',$tag);
      $relaseDate = $product->created_at->format('d-F-Y');
      //============== Related Product ==============
      $cat_id = $product->category_id;
      $relatedProducts = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();

      return view('fontend.product_details',compact('product','product_size','relaseDate','product_tag','relatedProducts'));
    }

    // ------------------- category wise product -------------------
    public function categoryWiseProduct($id,$slug){
        $category = Category::orderBy('id','DESC')->get();
        $newProduct = Product::orderBy('id','DESC')->limit(4)->get();
        $product = Product::where('category_id',$id)->orderBy('id','DESC')->paginate(15);
        $pcount = Product::where('category_id',$id)->count();
        return view('fontend.catg_wise_product',compact('product','newProduct','category','pcount'));
    }


    // ------------------- brand wise product -------------------
    public function brandWiseProduct($id,$slug){
      // do work
      $brand = Brand::orderBy('id','DESC')->get();
      $newProduct = Product::orderBy('id','DESC')->limit(4)->get();
      $product = Product::where('brand_id',$id)->orderBy('id','DESC')->paginate(15);
      $pcount = Product::where('brand_id',$id)->count();
      return view('fontend.brand_wise_product',compact('product','newProduct','brand','pcount'));
      // do work
    }

    // shop page view
    public function shop(Request $request){
        $category = Category::with('product')->orderBy('id','DESC')->get();
        $brands = Brand::with('product')->orderBy('id','DESC')->get();
        $count = Product::count();
        /* ========== sort assending to desending ========== */
        $shopProduct = Product::query();

        //category filter
        if (!empty($_GET['category'])) {
            $slugs = explode(',',$_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug',$slugs)->pluck('id')->toArray();
            $shopProduct = $shopProduct->whereIn('category_id',$catIds);
        }

        //brand filter
        if (!empty($_GET['brand'])) {
            $slugs = explode(',',$_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('brand_slug',$slugs)->pluck('id')->toArray();
            $shopProduct = $shopProduct->whereIn('brand_id',$brandIds);
        }


        $sort = '';
        if ($request->sort != null) {
             $sort = $request->sort;
        }

        if ($sort == 'priceLowtoHigh') {
            $shopProduct = Product::where(['status' => 1])->orderBy('selling_price','ASC')->paginate(12);
        }elseif ($sort == 'priceHightoLow') {
            $shopProduct = Product::where(['status' => 1])->orderBy('selling_price','DESC')->paginate(12);
        }elseif ($sort == 'nameAtoZ') {
            $shopProduct = Product::where(['status' => 1])->orderBy('product_name','ASC')->paginate(12);
        }elseif ($sort == 'nameZtoA') {
            $shopProduct = Product::where(['status' => 1])->orderBy('product_name','DESC')->paginate(12);
        }else {
            $shopProduct = Product::where('status',1)->orderBy('id','DESC')->paginate(5);
        }
        /* ========== sort assending to desending ========== */

        /* ========== route ========== */
        $route = '/shop';
        /* ========== route ========== */
        return view('fontend.shop',compact('shopProduct','category','count','brands','route','sort'));
    }

    // shop filtering
    public function shopFilter(Request $request){
        $data = $request->all();

        //filter category
        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category='.$category;
                }else {
                    $catUrl .= ','.$category;
                }
            }
        }

        //filter brand
        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand='.$brand;
                }else {
                    $brandUrl .= ','.$brand;
                }
            }
        }


        return redirect()->route('shop',$catUrl,$brandUrl);

    }

    // shop page view

    // cart page view
    public function cart(){
        return view('fontend.cart');
    }
    // cart page view

    // Checkout page view
    public function checkout(){
        // do work
        if (Auth::check()) {
           if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                // $divisions = ShipDivision::orderBy('division_name','ASC')->get();
                return view('fontend.checkout',compact('carts','cartQty','cartTotal',));
           }else {
            $notification=array(
                'message'=>'Shopping Now',
                'alert-type'=>'error'
            );
            return Redirect()->to('/')->with($notification);
           }
        }else {
            $notification=array(
                'message'=>'You Nedd to Login First',
                'alert-type'=>'error'
            );
            return Redirect()->route('login')->with($notification);
        }
        // do work
    }
    // Checkout page view


    //-------------------------- do work --------------------------
}
