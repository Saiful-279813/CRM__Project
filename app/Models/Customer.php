<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
      return $this->belongsTo('App\Models\User','customer_creator','id');
    }

    public function employee(){
      return $this->belongsTo(Employee::class,'employee_id','employee_id');
    }

    public function visa(){
      return $this->hasOne(CustomerVisa::class, 'customer_id','customer_id');
    }
}
