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
            $table->timestamps();
            $table->string('payment_intent_id');
            $table->string('amount');
            $table->string('currency');
            $table->string('status');
            $table->string('payment_method');
            $table->boolean('captured');
            $table->string('charge_id');
            $table->boolean('paid');
            $table->boolean('refunded');
            $table->string('receipt_url');
            $table->string('card_last4')->nullable();
            $table->string('card_exp')->nullable();
            $table->string('card_brand')->nullable();
            $table->enum('type', [
                'order',
                'tip'
            ])->default('order');
            $table->unsignedBigInteger('order_id');

            $table->foreign('order_id')->references('id')->on('orders');
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
