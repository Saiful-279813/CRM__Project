<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;
use Session;
use Image;

class SettingController extends Controller{
    // do work
    public function index(){
      $data = Setting::where('id',1)->first();
      return view('admin.setting.index',compact('data'));
    }

    public function informationUpdate(Request $request){
        // validation
        $this->validate($request,[
          'site_name' => 'required'
        ],[

        ]);
        // validation
        $data = $request->all();
        Setting::where('id',1)->update($data);
        // redirect
        Session::flash('success_update','value');
        return redirect()->back();
    }

    public function aboutInfoUpdate(Request $request){
         $this->validate($request,[
           'ab_page_title' => 'required',
           'ab_page_image' => 'required'
         ],[

         ]);

         Setting::where('id',1)->update([
           'ab_page_title' => $request->ab_page_title,
           'ab_page_description' => $request->ab_page_description,
           'updated_at' => Carbon::now(),
         ]);
         if($request->file('ab_page_image')){
            // ___________ Unlink _____________
             if($request->oldab_page_image != ""){
               unlink($request->oldab_page_image);
             }
             // +++++++++++++++ make Image +++++++++++++++
             $image = $request->file('ab_page_image');
             $imageName = 'about-page-thumbnail'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
             Image::make($image)->resize(1292,1472)->save('uploads/setting/'.$imageName);
             $saveUrl = 'uploads/setting/'.$imageName;
             // +++++++++++++++ make Image +++++++++++++++
             Setting::where('id',1)->update([
               'ab_page_image' => $saveUrl,
               'updated_at' => Carbon::now(),
             ]);
         }
         // redirect
         Session::flash('success_update_about_page','value');
         return redirect()->back();
    }

    public function logoUpdate(Request $request){
        if($request->oldLogo != ""){
          unlink($request->oldLogo);
        }

        // make Image
        $image = $request->file('logoimage');
        $imageName = 'logo-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/setting/'.$imageName);
        $saveUrl = 'uploads/setting/'.$imageName;
        // make Image
        Setting::where('id',1)->update([
          'logo' => $saveUrl,
          'updated_at' => Carbon::now(),
        ]);
        // redirect
        Session::flash('success_update_logo','value');
        return redirect()->back();

    }

    public function defaultImageUpdate(Request $request){
        if($request->oldDefaultImage != ""){
          unlink($request->oldDefaultImage);
        }

        // make Image
        $image = $request->file('default_image');
        $imageName = 'default-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/setting/'.$imageName);
        $saveUrl = 'uploads/setting/'.$imageName;
        // make Image
        Setting::where('id',1)->update([
          'default_image' => $saveUrl,
          'updated_at' => Carbon::now(),
        ]);
        // redirect
        Session::flash('success_update_default','value');
        return redirect()->back();

    }

    public function faviconUpdate(Request $request){
        if($request->oldFavicon != ""){
          unlink($request->oldFavicon);
        }

        // make Image
        $image = $request->file('fav_icon');
        $imageName = 'fav-icon'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/setting/'.$imageName);
        $saveUrl = 'uploads/setting/'.$imageName;
        // make Image
        Setting::where('id',1)->update([
          'fav_icon' => $saveUrl,
          'updated_at' => Carbon::now(),
        ]);
        // redirect
        Session::flash('success_update_favicon','value');
        return redirect()->back();

    }
    // do work
}
