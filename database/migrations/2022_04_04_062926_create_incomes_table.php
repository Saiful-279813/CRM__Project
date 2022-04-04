<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->bigIncrements('income_id');
            $table->unsignedBigInteger('in_cat_id');
            $table->integer('income_amount')->default(0);
            $table->text('income_details')->nullable();
            $table->date('income_date');
            $table->integer('income_creator')->nullable();
            $table->string('income_slug')->nullable();
            $table->boolean('income_status')->default(0);
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
        Schema::dropIfExists('incomes');
    }
}
