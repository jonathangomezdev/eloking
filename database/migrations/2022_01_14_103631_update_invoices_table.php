<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table){
            $table->dropColumn('invoice_link');

            $table->string('vendor_name')->nullable()->change();
            $table->string('vendor_street')->nullable()->change();
            $table->string('vendor_city')->nullable()->change();
            $table->string('vendor_state')->nullable()->change();
            $table->string('vendor_country')->nullable()->change();
            $table->string('vendor_postcode')->nullable()->change();
            $table->string('vendor_vat_rate')->nullable()->change();
            $table->string('vendor_vat_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table){
            $table->text('invoice_link');
        });
    }
}
