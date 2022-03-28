<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\VisaTypeController;
use App\Http\Controllers\Admin\CustomerVisaController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Admin\SalaryController;
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
    Route::get('customer/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');
    // --------------- Customers ------------------

    // --------------- Customer visa Type ------------------
    Route::resource('visa-type', VisaTypeController::class);
    // --------------- Customer visa Type ------------------

    // --------------- Customer visa ------------------
    Route::resource('customer-visa', CustomerVisaController::class);
    // --------------- Customer visa ------------------

    // --------------- Employee ------------------
    Route::resource('employee', EmployeeController::class);
    Route::get('employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    // --------------- Employee ------------------

    // --------------- Blood Group ------------------
    Route::resource('blood', BloodGroupController::class);
    // --------------- Blood Group ------------------

    // --------------- Department ------------------
    Route::resource('department', DepartmentController::class);
    // --------------- Department ------------------

    // --------------- Designation ------------------
    Route::resource('designation', DesignationController::class);
    // --------------- Designation ------------------

    // --------------- EmployeeType ------------------
    Route::resource('employee-type', EmployeeTypeController::class);
    // --------------- EmployeeType ------------------

    // --------------- Employee ------------------
    Route::resource('employee', EmployeeController::class);
    // --------------- Employee ------------------

    // --------------- Salary Details ------------------
    Route::resource('salary', SalaryController::class);
    // --------------- Salary Details ------------------







});







// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
