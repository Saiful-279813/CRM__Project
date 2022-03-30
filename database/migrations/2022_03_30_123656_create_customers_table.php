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
            $table->bigIncrements('customer_id');
            $table->string('customer_id_number',50)->unique();
            $table->string('customer_name',50)->nullable();
            $table->string('customer_father',50)->nullable();
            $table->string('customer_phone',20)->unique();
            $table->string('customer_email',50)->nullable();
            $table->text('customer_address')->nullable();

            /* ================ visa information ================ */
            $table->string('visa_number',60)->unique();
            $table->string('passport_number',60)->unique();
            $table->string('pp_location')->nullable();
            $table->boolean('vecxin')->default(0);
            $table->boolean('PC')->default(0);
            $table->boolean('medical')->default(0);
            $table->date('madical_date')->nullable();
            $table->string('report',12)->default('PENDING');
            $table->boolean('visa_online')->default(0);
            $table->boolean('visa')->default(0);
            $table->boolean('training')->default(0);
            $table->boolean('manpower')->default(0);
            $table->boolean('ticket')->default(0);
            $table->string('work',100)->nullable();

            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();

            $table->string('visa_duration',20)->nullable();
            $table->string('visa_name',60)->nullable();
            $table->text('visa_remarks')->nullable();


            /* ================ visa information ================ */

            /* ================ photo ================ */
            $table->string('customer_photo',50)->nullable();
            $table->string('visa_image')->nullable();
            $table->string('passport_image')->nullable();
            /* ================ photo ================ */


            $table->unsignedBigInteger('place_country_id')->nullable();
            $table->unsignedBigInteger('visa_type_id')->nullable();
            $table->unsignedBigInteger('employee_id')->comments('refference Officer')->nullable();
            $table->date('apply_date');
            $table->integer('customer_creator')->nullable();
            $table->string('customer_slug',50)->nullable();
            $table->boolean('customer_status')->default(1);

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
