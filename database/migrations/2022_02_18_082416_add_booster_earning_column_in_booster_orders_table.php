<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoosterEarningColumnInBoosterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booster_orders', function (Blueprint $table) {
            $table->float('earning_with_penalty')->nullable();
            $table->float('earning_without_penalty')->nullable();
            $table->float('penalty')->nullable();
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
            $table->dropColumn('earning_with_penalty');
            $table->dropColumn('earning_without_penalty');
            $table->dropColumn('penalty');
        });
    }
}
