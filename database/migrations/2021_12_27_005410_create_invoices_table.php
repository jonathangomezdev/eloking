<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->enum('invoice_from', [
                'eloking',
                'booster',
            ]);
            $table->enum('invoice_for', [
                'customer',
                'booster',
            ]);
            $table->text('invoice_link');
            $table->string('invoice_number');
            $table->unsignedBigInteger('order_id');
            $table->string('vendor_company')->nullable();
            $table->string('vendor_name');
            $table->string('vendor_street');
            $table->string('vendor_city');
            $table->string('vendor_state');
            $table->string('vendor_country');
            $table->string('vendor_postcode');
            $table->string('vendor_vat_number')->nullable();
            $table->float('vendor_vat_rate')->default(0);
            $table->text('customer_name');
            $table->longText('note')->nullable();
            $table->longText('description');
            $table->float('subtotal');
            $table->float('total');

            $table->timestamps();
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
        Schema::dropIfExists('invoices');
    }
}
