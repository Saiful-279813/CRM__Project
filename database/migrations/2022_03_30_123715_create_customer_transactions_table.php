<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_transactions', function (Blueprint $table) {
            $table->bigIncrements('cust_trans_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('full_contact')->default(0);
            $table->integer('total_pay')->default(0);
            $table->integer('due_to_admin')->default(0);
            $table->integer('payment_to_admin')->default(0);
            $table->integer('cost')->default(0);
            $table->integer('officer_commision')->default(0);
            $table->integer('agent_commision')->default(0);
            $table->date('date');
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
        Schema::dropIfExists('customer_transactions');
    }
}
