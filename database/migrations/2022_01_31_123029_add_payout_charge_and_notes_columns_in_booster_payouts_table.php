<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayoutChargeAndNotesColumnsInBoosterPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booster_payouts', function (Blueprint $table) {
            $table->float('fee')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->unsignedBigInteger('booster_payout_id')->nullable();
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booster_payouts', function (Blueprint $table) {
            $table->dropColumn('fee');
            $table->dropColumn('paid_at');
            $table->dropColumn('booster_payout_id');
            $table->dropColumn('note');
        });
    }
}
