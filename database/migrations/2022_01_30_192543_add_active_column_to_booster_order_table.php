<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveColumnToBoosterOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booster_orders', function (Blueprint $table) {
            $table->boolean('active')->default(true);
            $table->text('drop_comment')->nullable();
            $table->string('progressed_rank')->nullable();
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
            $table->dropColumn('active');
            $table->dropColumn('drop_comment');
            $table->dropColumn('progressed_rank');
        });
    }
}
