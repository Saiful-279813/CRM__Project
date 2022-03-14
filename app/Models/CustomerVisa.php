<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerVisa extends Model
{
    use HasFactory;
    protected $fillable = [
      'customer_id','visa_number','passport_number','from_date','to_date','visa_duration','place_of_issue','visa_type',
      'visa_name','visa_remarks','visa_image','passport_image'
    ];

    public function customer(){
      return $this->belongsTo(Customer::class);
    }

}
