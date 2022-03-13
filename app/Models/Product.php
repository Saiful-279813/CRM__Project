<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'product_name', 'product_slug', 'product_code', 'product_qty',
        'product_tags', 'selling_price', 'product_thambnail'
      ];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function brand(){
      return $this->belongsTo(Brand::class);
    }

    public function category(){
      return $this->belongsTo(Category::class);
    }

    public function subcategory(){
      return $this->belongsTo(SubCategory::class);
    }

    public function thirdcategory(){
      return $this->belongsTo(ThirdCategory::class);
    }

    public function productImage(){
      return $this->hasMany(ProductImage::class);
    }

}
