<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoPenaltyCurrentLpColumnsToBoosterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booster_orders', function (Blueprint $table) {
            $table->boolean('no_penalty')->default(false);
            $table->string('current_lp')->nullable();
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
            $table->dropColumn('no_penalty');
            $table->dropColumn('current_lp');
        });
    }
}
