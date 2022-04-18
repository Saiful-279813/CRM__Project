<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthWorkHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('month_work_histories', function (Blueprint $table) {
            $table->id('month_work_id');
            $table->integer('employee_id');
            $table->integer('month_id');
            $table->integer('year');
            $table->integer('overtime_amount')->default(0);
            $table->integer('deduction_amount')->default(0);
            $table->integer('total_work_day')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('create_by');
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
        Schema::dropIfExists('month_work_histories');
    }
}
