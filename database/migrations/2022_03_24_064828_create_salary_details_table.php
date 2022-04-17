<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_details', function (Blueprint $table) {
            $table->id('sdetails_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('basic_amount')->default(0);
            $table->integer('mobile_allowance')->default(0);
            $table->integer('medical_allowance')->default(0);
            $table->integer('house_allowance')->default(0);
            $table->integer('others_allowance')->default(0);
            $table->integer('total_salary')->default(0);
            $table->integer('increment_no')->default(0);
            $table->float('increment_amount',11,2)->default(0);
            // $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('salary_details');
    }
}
