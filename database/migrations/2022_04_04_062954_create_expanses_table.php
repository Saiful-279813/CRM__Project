<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpansesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expanses', function (Blueprint $table) {
            $table->bigIncrements('expens_id');
            $table->unsignedBigInteger('exp_cat_id');
            $table->integer('expens_amount')->default(0);
            $table->text('expens_details')->nullable();
            $table->date('expens_date');
            $table->integer('expens_creator')->nullable();
            $table->string('expens_slug')->nullable();
            $table->boolean('expens_status')->default(0);
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
        Schema::dropIfExists('expanses');
    }
}
