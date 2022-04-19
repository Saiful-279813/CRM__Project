<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_histories', function (Blueprint $table) {
            $table->bigIncrements('slh_auto_id');
            $table->unsignedBigInteger('employee_id');
            // =============== Salary History ===============
            $table->integer('basic_amount')->default(0);
            $table->integer('mobile_allowance')->default(0);
            $table->integer('medical_allowance')->default(0);
            $table->integer('house_allowance')->default(0);
            $table->integer('others_allowance')->default(0);
            $table->integer('total_salary')->default(0);
            $table->integer('increment_no')->default(0);
            $table->integer('increment_amount')->default(0);

            $table->integer('slh_total_overtime')->default(0);
            $table->integer('slh_overtime_amount')->default(0);
            $table->integer('slh_total_working_days');
            $table->integer('deduction_amount')->default(0);
            // =========== Advance Payment ==============
            $table->integer('slh_advance')->default(0);
            $table->integer('slh_advance_amount')->default(0);
            // =========== Commision Payment ==============
            $table->integer('slh_commision')->default(0);
            $table->integer('slh_commision_amount')->default(0);

            $table->date('slh_salary_date');
            $table->integer('slh_month');
            $table->integer('slh_year');
            $table->enum('status',['pending','paid'])->default('pending');
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
        Schema::dropIfExists('salary_histories');
    }
}
