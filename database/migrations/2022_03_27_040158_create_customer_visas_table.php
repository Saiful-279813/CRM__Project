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
            $table->id('customer_visa_id');
            // =========== New Include ===========
            $table->unsignedBigInteger('customer_id');
            $table->boolean('vecxin')->default(0);
            $table->boolean('PC')->default(0);
            $table->boolean('medical')->default(0);
            $table->date('madical_date')->nullable();
            $table->enum('report',['FIT','UNFIT','PENDING'])->default('PENDING');
            $table->boolean('visa_online')->default(0);
            $table->boolean('visa_offline')->default(0);
            $table->boolean('training')->default(0);
            $table->boolean('manpower')->default(0);
            $table->boolean('ticket')->default(0);
            // =========== New Include ===========
            // visa ===========
            $table->string('visa_number',60)->unique()->nullable();
            $table->string('passport_number',60)->unique()->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();

            $table->string('visa_duration',20)->nullable();

            $table->unsignedBigInteger('place_country_id')->nullable();
            $table->unsignedBigInteger('visa_type_id')->nullable();
            $table->string('visa_name',60)->nullable();
            $table->text('visa_remarks')->nullable();
            $table->string('visa_image')->nullable();
            $table->string('passport_image')->nullable();
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            // visa ===========
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
