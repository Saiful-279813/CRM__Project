<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpanseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expanse_categories', function (Blueprint $table) {
            $table->bigIncrements('exp_cat_id');
            $table->string('exp_cat_name')->unique();
            $table->text('exp_cat_remarks')->nullable();
            $table->integer('exp_cat_creator')->nullable();
            $table->string('exp_cat_slug')->nullable();
            $table->boolean('exp_cat_status')->default(1);
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
        Schema::dropIfExists('expanse_categories');
    }
}
