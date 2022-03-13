<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('temp_user_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->text('variation')->nullable();
            $table->integer('quantity')->default(1);
            $table->double('price',20,2)->nullable();
            $table->string('coupon_code')->nullable();
            $table->tinyInteger('coupon_applied')->default(0);
            $table->double('discount',10,2)->nullable();
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
        Schema::dropIfExists('carts');
    }
}
