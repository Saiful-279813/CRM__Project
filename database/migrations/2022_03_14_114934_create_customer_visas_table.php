<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_visas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('visa_number',60)->unique()->nullable();
            $table->string('passport_number',60)->unique()->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('visa_duration',20)->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('visa_type')->nullable();
            $table->string('visa_name')->nullable();
            $table->text('visa_remarks')->nullable();
            $table->string('visa_image')->nullable();
            $table->string('passport_image')->nullable();
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
        Schema::dropIfExists('customer_visas');
    }
}
