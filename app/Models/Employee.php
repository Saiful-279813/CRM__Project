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
}
