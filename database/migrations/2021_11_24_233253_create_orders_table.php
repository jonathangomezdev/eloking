<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->timestamps();
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('gametype');
            $table->float('booster_earning_EUR')->nullable();
            $table->string('platform');
            $table->string('type');
            $table->string('region')->nullable();
            $table->float('total_EUR')->nullable();
            $table->float('total_refunded_EUR')->nullable();
            $table->float('total')->nullable();
            $table->string('currency')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->json('payload')->nullable();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
