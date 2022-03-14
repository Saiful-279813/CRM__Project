<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
      'customer_name','customer_father','customer_phone','customer_email','customer_address','customer_photo','total_cost',
      'payment','due','apply_date','customer_creator','customer_slug'
    ];

    public function visa(){
      return $this->hasOne(CustomerVisa::class);
    }

    public function user(){
      return $this->belongsTo(User::class);
    }
}
