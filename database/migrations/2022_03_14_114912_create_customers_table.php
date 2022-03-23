<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id_number',50)->unique()->nullable();
            $table->string('customer_name',50)->nullable();
            $table->string('customer_father',50)->nullable();
            $table->string('customer_phone',20)->unique();
            $table->string('customer_email',50)->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_photo',50)->nullable();
            $table->integer('total_cost');
            $table->integer('payment');
            $table->integer('due')->default(0);
            // visa ===========
            $table->string('visa_number',60)->unique()->nullable();
            $table->string('passport_number',60)->unique()->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('visa_duration',20)->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('visa_type',60)->nullable();
            $table->string('visa_name',60)->nullable();
            $table->text('visa_remarks')->nullable();
            $table->string('visa_image')->nullable();
            $table->string('passport_image')->nullable();
            // visa ===========
            $table->date('apply_date');
            $table->integer('customer_creator')->nullable();
            $table->string('customer_slug',50)->nullable();
            $table->boolean('customer_status')->default(1);
            $table->string('_token')->nullable();
            $table->string('_method')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
