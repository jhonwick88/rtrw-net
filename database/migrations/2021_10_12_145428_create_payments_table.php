<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->dateTime('pay_date', 0)->nullable();
            $table->integer('total')->default(0);
            $table->foreignId('user_id')->nullable();
            $table->foreignId('payment_method_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->integer('status')->default(2); //1 Paid 2 Unpaid
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
        Schema::dropIfExists('payments');
    }
}
