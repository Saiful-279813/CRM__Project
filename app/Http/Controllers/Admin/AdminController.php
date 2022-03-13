<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactForm;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class AdminController extends Controller{
     public function index(){
       return view('admin.index');
     }

     public function notifications(){
       $notifications = ContactForm::orderBy('id','DESC')->get();
       return view('admin.notifications.index',compact('notifications'));
     }

     public function notificationsDelete($id){
        ContactForm::where('id',$id)->delete();
        Session::flash('success_delete','value');
        return redirect()->back();
     }

     public function profile(){
       return view('admin.profile.index');
     }

     public function profileInfoUpdate(Request $request){
        /* ============== form validation ============== */
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|max:11|min:11',
        ]);
        /* ============== update user info ============== */
        $update = User::where('id',Auth::user()->id)->update([
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'updated_at' => Carbon::now(),
        ]);

        Session::flash('user_info_update','value');
        return redirect()->back();
     }

     /* ============== update user password ============== */
     public function profilePasswordUpdate(Request $request){
       // ============= Do work ==================
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required|min:8',
        ]);

        $db_pass = Auth::user()->password;
        $current_password = $request->old_password;
        $newpass = $request->new_password;
        $confirmpass = $request->password_confirmation;

       if (Hash::check($current_password,$db_pass)) {
          if ($newpass === $confirmpass) {
              User::findOrFail(Auth::id())->update([
                'password' => Hash::make($newpass),
                'updated_at' => Carbon::now(),
              ]);

              Auth::logout();
              $notification=array(
                'message'=>'Your Password Change Success. Now Login With New Password',
                'alert-type'=>'success'
            );
            return Redirect()->route('login')->with($notification);

          }else {

            $notification=array(
                'message'=>'New Password And Confirm Password Not Same',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
          }
       }else {
        $notification=array(
            'message'=>'Old Password Not Match',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
       }
       // ============= Do work ==================
     }

     public function profileImageUpdate(Request $request){
       $user = User::where('id',Auth::user()->id)->first();
         if($user->upload_photo_path != NULL){
           unlink($user->upload_photo_path);
         }
         // ========= make image =========
         $image = $request->file('image');
         $imageName = 'user-image'.'-'.uniqid().'-'.$image->getClientOriginalExtension();
         Image::make($image)->resize(100,100)->save('uploads/user/'.$imageName);
         $saveUrl = 'uploads/user/'.$imageName;
         // ========= make image =========
         User::findOrFail(Auth::id())->update([
           'upload_photo_path' => $saveUrl,
           'updated_at' => Carbon::now(),
         ]);
         Session::flash('success__image__upload','value');
         return redirect()->back();
     }

}
