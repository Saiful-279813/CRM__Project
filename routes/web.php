<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix'=>'admin','middleware' =>['admin','auth']], function(){
    Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class, 'profile'])->name('admin.profile');
    // --------------- User profile modify ------------------
    Route::post('profile/info/update',[AdminController::class, 'profileInfoUpdate'])->name('auth-user-info-update');
    Route::post('profile/password/update',[AdminController::class, 'profilePasswordUpdate'])->name('auth-user-password-update');
    Route::post('profile/image/update',[AdminController::class, 'profileImageUpdate'])->name('auth-user-image-update');

    // --------------- Role & Permission ------------------
    Route::resource('roles', RoleController::class);
    Route::get('roles/delete/{id}', [UserController::class, 'delete'])->name('roles.delete');
    Route::resource('users', UserController::class);
    Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    // --------------- Role & Permission ------------------

    // --------------- Customers ------------------
    Route::resource('customers', CustomerController::class);
    Route::get('customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
    // --------------- Customers ------------------



});







// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
