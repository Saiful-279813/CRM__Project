<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'customer_id';

    public function employee(){
      return $this->belongsTo(Employee::class);
    }

    public function customer_trnasaction(){
      return $this->hasOne(CustomerTransactions::class);
    }

    public function customer_pay(){
      return $this->hasMany(CustomerPayment::class);
    }
}
