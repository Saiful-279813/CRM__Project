<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('ID_Number',15);
            $table->string('employee_name',50);
            $table->string('employee_father',50);
            $table->string('employee_mother',50);
            $table->string('mobile_no',20);
            $table->string('email',50)->nullable();
            $table->string('nid',20)->nullable();
            $table->integer('blood_group_id')->nullable();

            $table->date('date_of_birth')->nullable();

            $table->string('present_address');
            $table->string('parmanent_address');

            $table->integer('designation_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('emp_type_id')->nullable();

            $table->boolean('maritus_status');
            $table->string('gender',10);
            $table->date('joining_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->date('appointment_date')->nullable();
            /* ============= image collection ============= */
            $table->string('profile_photo',60)->nullable();
            $table->string('nid_photo',60)->nullable();
            /* ============= image collection ============= */
            $table->enum('job_status',['pending','approve','leave','reject'])->default('pending');
            $table->unsignedBigInteger('employee_creator');
            $table->string('employee_slug');
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
        Schema::dropIfExists('employees');
    }
}
