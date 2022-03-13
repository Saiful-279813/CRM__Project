<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('brand_slug');
            $table->string('brand_image')->nullable();
            $table->boolean('product_status')->default(0);
            $table->integer('user')->nullable();
            $table->integer('brand_name2')->nullable();
            $table->integer('_method')->nullable();
            $table->timestamps();
        });

        // insert data

        // insert data

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
