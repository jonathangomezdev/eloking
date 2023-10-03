<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPayoutMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payout_methods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('method');
            $table->json('details');
            $table->unsignedBigInteger('user_id');
            $table->boolean('active')->default(1);

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_payout_methods');
    }
}
