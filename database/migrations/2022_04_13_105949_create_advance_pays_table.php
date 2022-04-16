<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advance_pays', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('adv_pay_amount')->default(0);
            $table->string('adv_pay_remarks')->nullable();
            $table->date('adv_date')->nullable();
            $table->string('adv_month')->nullable();
            $table->string('adv_year')->nullable();
            $table->date('entry_date');
            $table->date('approve_date')->nullable();
            $table->integer('creator');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('advance_pays');
    }
}
