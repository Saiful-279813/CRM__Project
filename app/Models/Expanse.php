<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expanse extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'expens_id';

    public function joinExCat(){
      return $this->belongsTo('App\Models\ExpanseCategory', 'exp_cat_id', 'exp_cat_id');
    }

}
