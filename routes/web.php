<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ThirdCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SecondBannerController;
use App\Http\Controllers\Admin\OthersBannerController;
use App\Http\Controllers\Admin\ProductDeliveryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Fontend\FontendController;
use App\Http\Controllers\Fontend\CartController;
use App\Http\Controllers\Fontend\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FontendController::class, 'index']);
Route::get('/shop',[FontendController::class, 'shop'])->name('shop');
Route::get('/about',[FontendController::class, 'about'])->name('about');
Route::get('/brand',[FontendController::class, 'brand'])->name('brand');
Route::get('/hot-deals',[FontendController::class, 'hotDeals'])->name('hot-deals');
Route::get('/contact',[FontendController::class, 'contact'])->name('contact');
Route::post('/shop/filter',[FontendController::class, 'shopFilter'])->name('shop.filter');
Route::get('/cart',[FontendController::class, 'cart'])->name('cart');
Route::get('/checkout',[FontendController::class, 'checkout'])->name('checkout');
Route::post('newslatter/email/store',[FontendController::class, 'newslatterStore'])->name('newslatter-store');
Route::post('contact/info/store',[FontendController::class, 'contactInfoStore'])->name('send-user.contact');
// ============================ Search Controller ============================
Route::get('/search-products',[SearchController::class, 'searchProduct'])->name('search.product');
 Route::post('/find-products',[SearchController::class,'findProducts']);
// ============================ Search Controller ============================
// category wise product
Route::get('/category-wise-product/{id}/{slug}',[FontendController::class, 'categoryWiseProduct'])->name('category-wise.product');
// Brand wise product
Route::get('/brand-wise-product/{id}/{slug}',[FontendController::class, 'brandWiseProduct'])->name('brand-wise.product');
// product details
Route::get('/product-details/{id}/{slug}',[FontendController::class, 'productDetails'])->name('product-details');
// Cart controller
Route::post('/add-to-cart',[CartController::class, 'addToCart'])->name('addToCart');
Route::get('/view-to/minicart',[CartController::class, 'viewToMiniCart'])->name('productViewInMiniCart');
Route::get('/view-to/maincart',[CartController::class, 'viewToMainCart'])->name('productViewInMainCart');
Route::get('/minicart/product-remove/{rowId}',[CartController::class, 'removeToMiniCart']);
// ==================== Add To Cart ============================
Route::get('/cart-remove/{rowId}',[CartController::class, 'removeMainCart']);
Route::get('/cart-increment/{rowId}',[CartController::class, 'incrementCart']);
Route::get('/cart-decrement/{rowId}',[CartController::class, 'decrementCart']);
// ==================== coupon apply ============================
Route::post('/coupon/apply',[CartController::class, 'couponApply'])->name('coupon-apply');
Route::get('/coupon-calculation',[CartController::class, 'couponCalculation']);
Route::get('/coupon-remove',[CartController::class, 'removeCoupon']);
// ==================== Add To Wishlist ============================
Route::post('/add/product-in/wishlist',[CartController::class, 'addToWishlist'])->name('addToWishlist');
// Cart controller
// product view
Route::post('product/view/modal',[FontendController::class, 'productQuickView'])->name('productQuickView');
// product view

Auth::routes();

Route::group(['prefix'=>'admin','middleware' =>['admin','auth'] ], function(){
    Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class, 'profile'])->name('admin.profile');
    // --------------- User profile modify ------------------
    Route::post('profile/info/update',[AdminController::class, 'profileInfoUpdate'])->name('auth-user-info-update');
    Route::post('profile/password/update',[AdminController::class, 'profilePasswordUpdate'])->name('auth-user-password-update');
    Route::post('profile/image/update',[AdminController::class, 'profileImageUpdate'])->name('auth-user-image-update');
    // --------------- User Contact Massege ------------------
    Route::get('notifications/user',[AdminController::class, 'notifications'])->name('contact-massage');
    Route::get('notifications/user/delete/{id}',[AdminController::class, 'notificationsDelete'])->name('contact-massage.delete');
    // --------------- User Contact Massege ------------------

    // --------------- Role & Permission ------------------
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // --------------- Role & Permission ------------------

    // --------------- Review System ------------------
    Route::get('prouduct/review',[ProductReviewController::class, 'index'])->name('getReview');
    Route::get('prouduct/approve/{id}',[ProductReviewController::class, 'approve'])->name('review-approve');
    Route::get('prouduct/delete/{id}',[ProductReviewController::class, 'delete'])->name('review-delete');
    // --------------- Review System ------------------

    // --------------- Banner ------------------
    Route::resource('banner', BannerController::class);
    Route::get('banner/delete/{id}',[BannerController::class, 'delete'])->name('banner.delete');
    // --------------- Second Banner ------------------
    Route::resource('secondbanner', SecondBannerController::class);
    Route::get('secondbanner/delete/{id}',[SecondBannerController::class, 'delete'])->name('secondbanner.delete');
    // --------------- othes Banner ------------------
    Route::get('othersbanner',[OthersBannerController::class, 'index'])->name('othersbanner');
    Route::post('specialOffer/update',[OthersBannerController::class, 'updateSpecialBanner'])->name('specialBanner.update');
    Route::post('newslatter/update',[OthersBannerController::class, 'updateNewslatterBanner'])->name('newslatterBanner.update');
    // --------------- Coupon ------------------
    Route::resource('coupon', CouponController::class);
    Route::get('coupon/delete/{id}',[CouponController::class, 'delete'])->name('coupon.delete');
    // --------------- Brand ------------------
    Route::resource('brand', BrandController::class);
    // --------------- Category ------------------
    Route::get('category',[CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create',[CategoryController::class, 'create'])->name('category.create');
    Route::get('category/edit/{id}',[CategoryController::class, 'edit'])->name('category.edit');
    Route::get('category/destroy/{id}',[CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('category/store',[CategoryController::class, 'store'])->name('category.store');
    Route::post('category/update',[CategoryController::class, 'update'])->name('category.update');

    // --------------- Sub Category ------------------
    Route::get('subcategory',[SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::get('subcategory/create',[SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::get('subcategory/edit/{id}',[SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::get('subcategory/destroy/{id}',[SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
    Route::post('subcategory/store',[SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::post('subcategory/update',[SubCategoryController::class, 'update'])->name('subcategory.update');
    // ajax
    Route::get('subcategory/list/{category_id}',[SubCategoryController::class, 'getSubcategory']);
    // ajax
    // --------------- Sub Category ------------------

    // --------------- Third Category ------------------
    Route::get('thirdcategory',[ThirdCategoryController::class, 'index'])->name('thirdcategory.index');
    Route::get('thirdcategory/create',[ThirdCategoryController::class, 'create'])->name('thirdcategory.create');
    Route::get('thirdcategory/edit/{id}',[ThirdCategoryController::class, 'edit'])->name('thirdcategory.edit');
    Route::get('thirdcategory/destroy/{id}',[ThirdCategoryController::class, 'destroy'])->name('thirdcategory.destroy');
    Route::post('thirdcategory/store',[ThirdCategoryController::class, 'store'])->name('thirdcategory.store');
    Route::post('thirdcategory/update',[ThirdCategoryController::class, 'update'])->name('thirdcategory.update');
    // ajax
    Route::get('thirdcategory/list/{subcategory_id}',[ThirdCategoryController::class, 'getThirdcategory']);
    // ajax

    // --------------- Product ------------------
    Route::resource('products', ProductController::class);
    Route::get('product/delete/{id}',[ProductController::class, 'delete'])->name('products.delete');
    // --------------- Product ------------------

    // --------------- Report ------------------
    Route::get('report',[ReportController::class, 'report'])->name('report');
    Route::post('selling/report/proccess',[ReportController::class, 'sellingReportProcess'])->name('selling-report');
    Route::post('reject/report/proccess',[ReportController::class, 'returnReportProcess'])->name('reject-report');
    // --------------- Report ------------------

    // --------------- Order ------------------
    Route::group(['prefix'=>'orders'], function(){
      Route::get('new/list',[OrderController::class, 'newOrders'])->name('new-order');
      Route::get('confrim/list',[OrderController::class, 'confirmOrders'])->name('confirm-order');
      Route::get('reject/list',[OrderController::class, 'rejectOrders'])->name('reject-order');
      Route::get('cencel/list',[OrderController::class, 'cencelOrder'])->name('cencel-order');
      Route::get('sale/list',[OrderController::class, 'saleOrders'])->name('sale-order');
      // ============ details and delete ================
      Route::get('confirm/{id}',[OrderController::class, 'orderConfirm'])->name('order.confirm');
      Route::get('confirm-to-sale/{id}',[OrderController::class, 'confirmToSale'])->name('confirm-to-sale');
      Route::get('view/{id}',[OrderController::class, 'viewOrders'])->name('order.view');
      Route::get('pending-to-cencel/{id}',[OrderController::class, 'pendingToCancel'])->name('pendingToCancel');
      // ============ Invoice Download ================
      Route::get('invoice/download/{id}',[OrderController::class, 'invoice'])->name('invoice-download-for-admin');
    });
    // --------------- Order ------------------

    // --------------- Product Delivery ------------------
    Route::resource('pdelivery', ProductDeliveryController::class);
    Route::get('delivery/delete/{id}',[ProductDeliveryController::class, 'delete'])->name('pdelivery.delete');
    // --------------- Product Delivery ------------------

    // --------------- Settings ------------------
    Route::get('setting',[SettingController::class, 'index'])->name('setting.index');
    Route::post('setting/information/update',[SettingController::class, 'informationUpdate'])->name('setting.information.update');
    Route::post('setting/logo/update',[SettingController::class, 'logoUpdate'])->name('setting.logo.update');
    Route::post('setting/default-image/update',[SettingController::class, 'defaultImageUpdate'])->name('setting.default-image.update');
    Route::post('setting/fav-icon/update',[SettingController::class, 'faviconUpdate'])->name('setting.fav_icon.update');
    Route::post('about/information/update',[SettingController::class, 'aboutInfoUpdate'])->name('about.information.update');
    // --------------- Settings ------------------
});

Route::group(['prefix'=>'customer','middleware' =>['customer','auth'] ], function(){
    Route::get('dashboard',[CustomerController::class, 'index'])->name('user.dashboard');
    Route::post('info/modify', [CustomerController::class, 'AuthCustModify'])->name('customer-modify');
    // ------------------- Order View -------------------
    Route::get('order-details/{id}', [CustomerController::class, 'orderDetails'])->name('order-details');
    // ------------------- Order Review -------------------
    // ------------------- Order Tracking -------------------
    Route::post('order/tracking', [CustomerController::class, 'ordertracking'])->name('track-order');
    // ------------------- Order Tracking -------------------
    Route::get('order-review/{id}', [ReviewController::class, 'index'])->name('review-create');
    Route::post('order-review/submit', [ReviewController::class, 'reviewSubmit'])->name('review-submit');
    // ------------------- Wishlist -------------------
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('wishlist/list', [WishlistController::class, 'getWishList'])->name('getWishList');
    Route::get('wishlist-remove/{id}', [WishlistController::class, 'removeWishList']);
    // checkout controller
    Route::post('order/store', [CheckoutController::class, 'orderStore'])->name('customer.checkout.store');

});





// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
