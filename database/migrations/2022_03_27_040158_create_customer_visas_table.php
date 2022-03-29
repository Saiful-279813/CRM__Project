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
            $table->boolean('vecxin')->default(0); //done
            $table->boolean('PC')->default(0); //done
            $table->boolean('medical')->default(0); //done
            $table->date('madical_date')->nullable(); //done
            $table->string('report',12)->default('PENDING'); //done
            $table->boolean('visa')->default(0); //done

            $table->boolean('training')->default(0); //done


            $table->boolean('manpower')->default(0); //done
            $table->boolean('ticket')->default(0); //done
            // =========== New Include ===========
            // visa ===========
            $table->string('visa_number',60)->unique(); //done
            $table->string('passport_number',60)->unique(); //done
            $table->date('from_date')->nullable(); //done
            $table->date('to_date')->nullable(); //done

            $table->string('visa_duration',20)->nullable();

            $table->unsignedBigInteger('place_country_id')->nullable(); //done
            $table->unsignedBigInteger('visa_type_id')->nullable(); //done
            $table->string('visa_name',60)->nullable(); //done
            $table->text('visa_remarks')->nullable(); //done

            $table->string('visa_image')->nullable(); //done
            $table->string('passport_image')->nullable(); //done
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
