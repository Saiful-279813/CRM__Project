<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('thirdcategory_id')->nullable();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tags');
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->integer('selling_price');
            $table->integer('discount_price');
            $table->integer('tax');
            $table->longText('short_descp')->nullable();
            $table->longText('long_descp')->nullable();
            $table->string('product_thambnail');
            $table->boolean('hot_deals')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('special_offer')->nullable();
            $table->boolean('special_deals')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
