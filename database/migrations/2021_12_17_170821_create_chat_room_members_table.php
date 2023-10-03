<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_room_members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('chat_room_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('chat_room_id')->on('chat_rooms')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_room_members');
    }
}
