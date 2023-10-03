<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentIdColumnsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->renameColumn('stripe_payment_intent_id', 'payment_id');
            $table->string('payment_gateway')->default('stripe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->renameColumn('payment_id', 'stripe_payment_intent_id');
            $table->dropColumn('payment_gateway');
        });
    }
}
