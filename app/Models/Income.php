<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'income_id';

    public function joinInCat(){
      return $this->belongsTo('App\Models\IncomeCategory', 'in_cat_id', 'in_cat_id');
    }
}
