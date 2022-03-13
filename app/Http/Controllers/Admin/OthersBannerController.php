<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OthersBanner;
use Carbon\Carbon;
use Session;
use Image;

class OthersBannerController extends Controller{
    //do work
    public function index(){
      $data = OthersBanner::where('id',1)->first();
      return view('admin.othersbanner.index',compact('data'));
    }

    public function updateSpecialBanner(Request $request){
        // validation
          $this->validate($request,[
            'special_offer_banner_title' => 'required'
          ],[

          ]);
        // validation
        if($request->file('special_offer_banner')){
          // do work
          $data = OthersBanner::where('id',1)->first();
          if($data->special_offer_banner != NULL){
            unlink($data->special_offer_banner);
          }
          // make image
            $image = $request->file('special_offer_banner');
            $imageName = 'special-banner-image'.$image->getClientOriginalExtension();
            Image::make($image)->resize(540,769)->save('uploads/othersbanner/'.$imageName);
            $saveUrl = 'uploads/othersbanner/'.$imageName;
          // make image
          OthersBanner::where('id',1)->update([
            'special_offer_banner_title' => $request->special_offer_banner_title,
            'special_offer_banner' => $saveUrl,
            'updated_at' => Carbon::now(),
          ]);
          // do work
        }else{
          // do work
          OthersBanner::where('id',1)->update([
            'special_offer_banner_title' => $request->special_offer_banner_title,
            'updated_at' => Carbon::now(),
          ]);
          // do work
        }

        // redirect back
        Session::flash('success_special','value');
        return redirect()->back();
    }

    public function updateNewslatterBanner(Request $request){
        // validation
          $this->validate($request,[
            'newslatter_banner_title' => 'required'
          ],[

          ]);
        // validation
        if($request->file('newslatter_banner')){
          // do work
          $data = OthersBanner::where('id',1)->first();
          if($data->newslatter_banner != NULL){
            unlink($data->newslatter_banner);
          }
          // make image
            $image = $request->file('newslatter_banner');
            $imageName = 'newslatter-banner-image'.$image->getClientOriginalExtension();
            Image::make($image)->resize(978,533)->save('uploads/othersbanner/'.$imageName);
            $saveUrl = 'uploads/othersbanner/'.$imageName;
          // make image
          OthersBanner::where('id',1)->update([
            'newslatter_banner_title' => $request->newslatter_banner_title,
            'newslatter_banner_content' => $request->newslatter_banner_content,
            'newslatter_banner_url' => $request->newslatter_banner_url,
            'newslatter_banner' => $saveUrl,
            'updated_at' => Carbon::now(),
          ]);
          // do work
        }else{
          // do work
          OthersBanner::where('id',1)->update([
            'newslatter_banner_title' => $request->newslatter_banner_title,
            'newslatter_banner_content' => $request->newslatter_banner_content,
            'newslatter_banner_url' => $request->newslatter_banner_url,
            'updated_at' => Carbon::now(),
          ]);
          // do work
        }

        if($request->file('newslatter_banner_backgournd')){
            $data = OthersBanner::where('id',1)->first();
            if($data->newslatter_banner_backgournd != NULL){
              unlink($data->newslatter_banner_backgournd);
            }

            // make image
              $image = $request->file('newslatter_banner_backgournd');
              $imageName = 'newslatter-background-banner-image'.$image->getClientOriginalExtension();
              Image::make($image)->resize(2376,574)->save('uploads/othersbanner/'.$imageName);
              $saveUrl = 'uploads/othersbanner/'.$imageName;
            // make image
            OthersBanner::where('id',1)->update([
              'newslatter_banner_backgournd' => $saveUrl,
              'updated_at' => Carbon::now(),
            ]);

        }

        // redirect back
        Session::flash('success_newslatter','value');
        return redirect()->back();
    }

}
