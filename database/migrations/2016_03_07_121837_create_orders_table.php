<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('amount');
            $table->float('shipping_fees');
            $table->string('email');
            $table->string('shipto_firstname');
            $table->string('shipto_lastname');
            $table->string('shipto_street');
            $table->string('shipto_street2');
            $table->string('shipto_zip');
            $table->string('shipto_city');
            $table->string('shipto_country');
            $table->string('shipping_status');
            $table->string('tracking');
            $table->string('payment_status');
            $table->string('payment');
            $table->string('stripe_transaction_id');
            $table->datetime('date');
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
        Schema::drop('orders');
    }
}
