<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\VisaTypeController;
use App\Http\Controllers\Admin\CustomerTransactionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ComissionController;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\MonthWorkHistoryController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\SalaryGenerateController;
use App\Http\Controllers\Admin\IncomeCategoryController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\IncomeExpenseSummaryController;
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
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customer/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::get('customer/{customer_id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::get('customer/{customer_id}/show', [CustomerController::class, 'show'])->name('customers.show');
    Route::post('customer/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::post('customer/update', [CustomerController::class, 'update'])->name('customers.update');
    // =========== Photo ============
    Route::post('customer-photo/{customer_id}/update', [CustomerController::class, 'updatePhoto'])->name('customer-photo');
    Route::post('customer-visa-photo/{customer_id}/update', [CustomerController::class, 'updateVisaPhoto'])->name('customer-visa-image');
    Route::post('customer-passport-photo/{customer_id}/update', [CustomerController::class, 'updatePassportPhoto'])->name('customer-passport-image');
    // =========== Photo ============
    Route::get('customer/list-download', [CustomerController::class, 'customerListDownload'])->name('customer-list-download');
    Route::get('customer/invoice/{customer_id}', [CustomerController::class, 'customerInvoice'])->name('customers.invoice');
    Route::get('customer/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');
    // --------------- Customers ------------------

    // --------------- Customer visa Type ------------------
    Route::resource('customer-trnasaction', CustomerTransactionController::class);
    Route::get('customer-payment/{id}', [CustomerTransactionController::class, 'payment'])->name('customer-payment');
    Route::post('customer/payment-process/{cust_trans_id}', [CustomerTransactionController::class, 'paymentSubmit'])->name('customer-payment-process');
    // --------------- Customer visa Type ------------------

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
    Route::get('employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    Route::post('employee/nid-photo/update/{id}', [EmployeeController::class, 'nidPhotoUpdate'])->name('employee-nid-photo.change');
    Route::post('employee/profile-photo/update/{id}', [EmployeeController::class, 'profilePhotoUpdate'])->name('employee-profile-photo.change');

    Route::get('employee-approve', [EmployeeController::class, 'employeeApprove'])->name('employee-approve');
    /* ============= Employee Advance Payment ============= */
    Route::get('employee-advance', [EmployeeController::class, 'advancePay'])->name('employee-advance-pay');
    Route::get('pending/employee-advance', [EmployeeController::class, 'pendingAdvancePay'])->name('pending-advance-pay');
    Route::get('employee-advance/{id}/approve', [EmployeeController::class, 'advancePayApprove'])->name('employee-advance-pay-approve');
    Route::get('employee-job/{employee_id}/approve', [EmployeeController::class, 'employeeJob'])->name('employee.approve');
    Route::get('employee-advance/{id}/delete', [EmployeeController::class, 'advancePayDelete'])->name('employee-advance-pay-delete');
    Route::get('employee-advance/list', [EmployeeController::class, 'advancePayList'])->name('employee-advance-payList');
    Route::post('employee-advance-payment/store', [EmployeeController::class, 'advancePaymentStore'])->name('employee.advance-pay.store');
    // --------------- Employee ------------------
    // --------------- Employee Commision ------------------
    Route::resource('commision', ComissionController::class);
    Route::get('employee-commision/{id}/delete', [ComissionController::class, 'delete'])->name('commision.delete');
    // ---------------- pending commmistion ----------------
    Route::get('pending-commision/list', [ComissionController::class, 'pendingCommision'])->name('pending-commision');
    Route::get('employee-commision/{id}/approve', [ComissionController::class, 'commisionApprove'])->name('commision.approve');
    // --------------- Employee Commision ------------------


    // --------------- Month Work history ------------------
    Route::resource('month-work', MonthWorkHistoryController::class);
    // --------------- Month Work history ------------------


    // --------------- Salary Details ------------------
    Route::get('salary/generat', [SalaryGenerateController::class, 'index'])->name('salary-generate');
    Route::post('all-employee/salary/process', [SalaryGenerateController::class, 'allEmployeeSalaryProcess'])->name('all-employee-salary-process');
    Route::resource('salary', SalaryController::class);
    // --------------- Salary Details ------------------

    // --------------- Customer Search ------------------
    Route::post('customer-search', [SearchController::class, 'customer'])->name('customer-search');
    Route::post('employee-search', [SearchController::class, 'employee'])->name('employee-search');
    // --------------- Customer Search ------------------

    // --------------- Accounts & Finance ------------------
    // --------------- Income Category ------------------
    Route::resource('income-category', IncomeCategoryController::class);
    // --------------- Income ------------------
    Route::resource('income', IncomeController::class);
    Route::get('pending-income', [IncomeController::class, 'pendingIncome'])->name('pending-income');
    Route::get('approved-income/{income_id}', [IncomeController::class, 'approveIncome'])->name('approved-income');
    Route::get('delete-income/{income_id}', [IncomeController::class, 'deleteIncome'])->name('delete-income');
    // --------------- Expense Category ------------------
    Route::resource('expense-category', ExpenseCategoryController::class);
    // --------------- Expense ------------------
    Route::resource('expense', ExpenseController::class);
    Route::get('pending-expense', [ExpenseController::class, 'pendingExpense'])->name('pending-expense');
    Route::get('approved-expense/{expens_id}', [ExpenseController::class, 'approveExpense'])->name('approved-expense');
    Route::get('delete-expense/{expens_id}', [ExpenseController::class, 'deleteIncome'])->name('delete-expense');

    Route::get('summary', [IncomeExpenseSummaryController::class, 'index'])->name('income-expense.summary');

    // --------------- Accounts & Finance ------------------





});







// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
