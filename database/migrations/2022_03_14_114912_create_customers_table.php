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
            $table->id('customer_id');
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
            $table->unsignedBigInteger('employee_id')->comments('refference Officer');
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
