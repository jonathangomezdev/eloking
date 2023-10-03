<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFaceitCredentialsToAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_account_details', function (Blueprint $table) {
            $table->string('faceit_email')->nullable();
            $table->string('faceit_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_account_details', function (Blueprint $table) {
            $table->dropColumn('faceit_email');
            $table->dropColumn('faceit_password');
        });
    }
}
