<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->integer('commision_amount');
            $table->string('remarks');
            $table->date('entry_date');
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->date('approve_date')->nullable();
            $table->unsignedBigInteger('approve_by')->nullable();
            $table->unsignedBigInteger('creator');
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
        Schema::dropIfExists('commisions');
    }
}
