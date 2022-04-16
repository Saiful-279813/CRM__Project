<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function salary(){
      return $this->hasOne(SalaryDetails::class, 'employee_id','employee_id');
    }

    public function blood(){
      return $this->belongsTo(BloodGroup::class,'blood_group_id','blood_group_id');
    }

    public function designation(){
      return $this->belongsTo(EmployeeDesignation::class,'designation_id','designation_id');
    }

    public function department(){
      return $this->belongsTo(EmployeeDepartment::class,'department_id','department_id');
    }

    public function employeeType(){
      return $this->belongsTo(EmployeeType::class,'emp_type_id','emp_type_id');
    }

    public function creator(){
      return $this->belongsTo(User::class,'employee_creator','id');
    }


}
