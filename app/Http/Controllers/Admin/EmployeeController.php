<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\SalaryDetails;
use App\Models\AdvancePay;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class EmployeeController extends Controller
{
    /*+++++++++++++++++++++++++++*/
    // DATABASE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function getAll(){
      return $data = Employee::orderBy('employee_id','DESC')->get();
    }

    public function getTwo(){
      return $data = Employee::orderBy('employee_id','DESC')->select('employee_id','employee_name')->get();
    }

    public function getAllEmployeeId(){
      return $data = Employee::where('job_status','approve')->orderBy('employee_id','DESC')->select('employee_id','ID_Number','employee_name')->get();
    }

    public function findEmployee($id){
      return $data = Employee::where('employee_id',$id)->first();
    }

    public function employeeId(){
        $count = Employee::count();
        return $id = 'E10'.$count;
    }

    public function bloodGroup(){
      $bloodOBJ = new BloodGroupController();
      return $bloodOBJ->getAll();
    }

    public function department(){
      $departmentOBJ = new DepartmentController();
      return $departmentOBJ->getAll();
    }

    public function designation(){
      $designationOBJ = new DesignationController();
      return $designationOBJ->getAll();
    }

    public function employeeType(){
      $employeeType = new EmployeeTypeController();
      return $employeeType->getAll();
    }

    public function employeeInformation(){
      return $data = Employee::leftjoin('employee_types','employees.emp_type_id','=','employee_types.emp_type_id')
                             ->leftjoin('employee_departments','employees.department_id','=','employee_departments.department_id')
                             ->leftjoin('employee_designations','employees.designation_id','=','employee_designations.designation_id')
                             ->select(
                               'employees.employee_id',
                               'employees.ID_Number',
                               'employees.employee_name',
                               'employees.job_status',
                               /* Employee Table end */
                               'employee_types.title as typeTitle',
                               'employee_departments.title as departmentTitle',
                               'employee_designations.title as designationTitle',
                               )->get();
    }



    /*+++++++++++++++++++++++++++*/
    // BLADE OPERATION
    /*+++++++++++++++++++++++++++*/
    public function index()
    {
        $employees = $this->employeeInformation();
        return view('admin.employee.index',compact('employees'));
    }

    public function create(){
       $employeeId = $this->employeeId();
       $bloodGroup = $this->bloodGroup();
       $department = $this->department();
       $designation = $this->designation();
       $employeeType = $this->employeeType();
       return view('admin.employee.create',compact('employeeId','bloodGroup','department','designation','employeeType'));
    }

    public function store(Request $request){
        /* =============== Form Validation =============== */
        $request->validate([
          'employee_name' => 'required|min:3|max:50',
          'employee_father' => 'required|min:3|max:50',
          'employee_mother' => 'required|min:3|max:50',
          'mobile_no' => 'required|unique:employees,mobile_no',
          'nid' => 'required|unique:employees,nid',
          'present_address' => 'required|max:250',
          'parmanent_address' => 'required|max:250',
          'date_of_birth' => 'required',
          'maritus_status' => 'required',
          'gender' => 'required',
          'joining_date' => 'required',
          'designation_id' => 'required',
          'department_id' => 'required',
          'emp_type_id' => 'required',
        ]);

        // ============== insert data in database ===============
        $insert = Employee::insertGetId([
          'ID_Number' => $request->ID_Number,
          'employee_name' => $request->employee_name,
          'employee_father' => $request->employee_father,
          'employee_mother' => $request->employee_mother,
          'mobile_no' => $request->mobile_no,
          'email' => $request->email,
          'nid' => $request->nid,
          'blood_group_id' => $request->blood_group_id,
          'present_address' => $request->present_address,
          'parmanent_address' => $request->parmanent_address,
          'date_of_birth' => $request->date_of_birth,
          'maritus_status' => $request->maritus_status,
          'gender' => $request->gender,
          'joining_date' => $request->joining_date,
          'designation_id' => $request->designation_id,
          'department_id' => $request->department_id,
          'emp_type_id' => $request->emp_type_id,
          'employee_slug' => strtolower(str_replace(' ','-',$request->employee_name)),
          'employee_creator' => Auth::user()->id,
          'created_at' => Carbon::now(),
        ]);
        // ============= upload image ===============
        /* ============= Insert data in database ============== */
        if($request->file('profile_photo')){
          /* ========= make Image ========= */
          $image = $request->file('profile_photo');
          $imageName = 'image'.'-'.$request->ID_Number.'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(150,150)->save('uploads/employee/'.$imageName);
          $profile_photo = 'uploads/employee/'.$imageName;
          // ============ upload data in database =============
          $uploadProfile = Employee::where('employee_id',$insert)->update([
              'profile_photo' => $profile_photo,
              'updated_at' => Carbon::now(),
          ]);

        }

        if($request->file('nid_photo')){
          /* ========= make Image ========= */
          $image = $request->file('nid_photo');
          $imageName = 'nid_image'.'-'.$request->ID_Number.'-'.$image->getClientOriginalExtension();
          Image::make($image)->save('uploads/employee/'.$imageName);
          $nid_photo = 'uploads/employee/'.$imageName;
          // ============ upload data in database =============
          $uploadNid = Employee::where('employee_id',$insert)->update([
              'nid_photo' => $nid_photo,
              'updated_at' => Carbon::now(),
          ]);
        }
        /* ============ Insert visa ============ */
        SalaryDetails::insert([
          'employee_id' => $insert,
          'created_at' => Carbon::now(),
        ]);
        /* ========= flash massege ========= */
        Session::flash('success_store_first_step','value');
        return redirect()->route('salary.edit',$insert);
    }

    public function show($id){
        $data = $this->findEmployee($id);
        return view('admin.employee.view',compact('data'));
    }

    public function edit($id){
        $data = $this->findEmployee($id);
        $employeeId = $this->employeeId();
        $bloodGroup = $this->bloodGroup();
        $department = $this->department();
        $designation = $this->designation();
        $employeeType = $this->employeeType();
        return view('admin.employee.edit',compact('data','employeeId','bloodGroup','department','designation','employeeType'));
    }

    public function update(Request $request, $id){
        /* =============== Form Validation =============== */

        $this->validate($request,[
          'employee_name' => 'required|min:3|max:50',
          'employee_father' => 'required|min:3|max:50',
          'employee_mother' => 'required|min:3|max:50',
          'mobile_no' => 'required|unique:employees,mobile_no,'.$id.',employee_id',
          'nid' => 'required|unique:employees,nid,'.$id.',employee_id',
          'present_address' => 'required|max:250',
          'parmanent_address' => 'required|max:250',
          'date_of_birth' => 'required',
          'maritus_status' => 'required',
          'gender' => 'required',
          'joining_date' => 'required',
          'designation_id' => 'required',
          'department_id' => 'required',
          'emp_type_id' => 'required',
        ]);

        // update data in database
        $update = Employee::where('employee_id',$id)->update([
          'ID_Number' => $request->ID_Number,
          'employee_name' => $request->employee_name,
          'employee_father' => $request->employee_father,
          'employee_mother' => $request->employee_mother,
          'mobile_no' => $request->mobile_no,
          'email' => $request->email,
          'nid' => $request->nid,
          'blood_group_id' => $request->blood_group_id,
          'present_address' => $request->present_address,
          'parmanent_address' => $request->parmanent_address,
          'date_of_birth' => $request->date_of_birth,
          'maritus_status' => $request->maritus_status,
          'gender' => $request->gender,
          'joining_date' => $request->joining_date,
          'designation_id' => $request->designation_id,
          'department_id' => $request->department_id,
          'emp_type_id' => $request->emp_type_id,
          'employee_slug' => strtolower(str_replace(' ','-',$request->employee_name)),
          'employee_creator' => Auth::user()->id,
          'updated_at' => Carbon::now(),
        ]);

        /* ========= flash massege ========= */
        Session::flash('success_update','value');
        return redirect()->back();
    }

    public function nidPhotoUpdate(Request $request, $id){
        if($request->file('nid_photo')){
          if($request->old_nid_photo != ''){
            unlink($request->old_nid_photo);
          }
          /* ========= make Image ========= */
          $image = $request->file('nid_photo');
          $imageName = 'nid-image'.'-'.$request->ID_Number.'-'.$image->getClientOriginalExtension();
          Image::make($image)->save('uploads/employee/'.$imageName);
          $nid_photo = 'uploads/employee/'.$imageName;

          $update = Employee::where('employee_id',$id)->update([
            'nid_photo' => $nid_photo,
            'updated_at' => Carbon::now(),
          ]);
        }

        Session::flash('updateNidPhoto');
        return redirect()->back();

    }

    public function profilePhotoUpdate(Request $request, $id){
        if($request->file('profile_photo')){
          if($request->old_profile_photo != ''){
            unlink($request->old_profile_photo);
          }
          /* ========= make Image ========= */
          $image = $request->file('profile_photo');
          $imageName = 'image'.'-'.$request->ID_Number.'-'.$image->getClientOriginalExtension();
          Image::make($image)->resize(150,150)->save('uploads/employee/'.$imageName);
          $profile_photo = 'uploads/employee/'.$imageName;

          $update = Employee::where('employee_id',$id)->update([
            'profile_photo' => $profile_photo,
            'updated_at' => Carbon::now(),
          ]);
        }

        Session::flash('updateProfilePhoto');
        return redirect()->back();
    }

    /* =============== Employee Advance Payment =============== */
    public function advancePay(){
      $employeeId = $this->getAllEmployeeId();
      return view('admin.employee.advance.create',compact('employeeId'));
    }

    public function advanceApplyEmployee(){
      return $data = AdvancePay::leftjoin('employees','advance_pays.employee_id','=','employees.employee_id')
                             ->leftjoin('salary_details','employees.employee_id','=','salary_details.employee_id')
                             ->select(
                               'salary_details.sdetails_id',
                               'salary_details.basic_amount',
                               'employees.employee_id',
                               'employees.ID_Number',
                               'employees.employee_name',
                               'advance_pays.*'
                               )->orderBy('id','DESC')->get();
    }

    public function advancePayList(){
      $dataList = $this->advanceApplyEmployee();
      return view('admin.employee.advance.index',compact('dataList'));
    }

    public function advancePaymentStore(Request $request){
      $times = Carbon::now();

      $countAdvancePay = AdvancePay::where('employee_id',$request->employee_id)->where('adv_month',$times->format('m'))->where('adv_year',$times->format('Y'))->count();

      // dd($countAdvancePay);

      if($countAdvancePay <= 2){
        $store = AdvancePay::insert([
          'employee_id' => $request->employee_id,
          'adv_pay_amount' => $request->advance_pay,
          'adv_pay_remarks' => $request->adv_pay_remarks,
          'entry_date' => $times,
          'adv_month' => $times->format('m'),
          'adv_year' => $times->format('Y'),
          'creator' => Auth::user()->id,
          'created_at' => Carbon::now(),
        ]);
      }else{
        Session::flash('limitCross');
        return redirect()->back();
      }



      Session::flash('requestSend');
      return redirect()->back();

    }

    public function advancePayDelete($id){
      $delete = AdvancePay::where('status',0)->where('id',$id)->delete();
      Session::flash('delete_success');
      return redirect()->back();
    }

    /* =============== Employee Approve =============== */
    public function pendingAdvancePay(){
      $dataList = $this->advanceApplyEmployee();
      return view('admin.employee.advance.administrator.index',compact('dataList'));
    }

    public function advancePayApprove($id){
      $approve = AdvancePay::where('status',0)->where('id',$id)->update([
        'status' => 1,
        'approve_date' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      Session::flash('advance_approve_success');
      return redirect()->back();
    }


    public function employeeApprove(){
      $employees = $this->employeeInformation();
      return view('admin.employee.administrator.index',compact('employees'));
    }

    public function employeeJob($id){
        $approve = Employee::where('job_status','pending')->where('employee_id',$id)->update([
          'job_status' => 'approve',
          'updated_at' => Carbon::now(),
        ]);
        Session::flash('employee_approve_success');
        return redirect()->back();
    }





}
