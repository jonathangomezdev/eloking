<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalEarningsColumnsToBoosterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booster_orders', function (Blueprint $table) {
            $table->renameColumn('earning_with_penalty', 'total')->comment('Total EUR Penalty + Earning');
            $table->renameColumn('earning_without_penalty', 'earning')->comment('It is earning of the booster excluding Penalty');
            $table->dropColumn('no_penalty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booster_orders', function (Blueprint $table) {
            $table->renameColumn('total', 'earning_with_penalty');
            $table->renameColumn('earning', 'earning_without_penalty');
            $table->boolean('no_penalty')->default(false);
        });
    }
}
