<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('room_id')->nullable();
            $table->bigInteger('to_user')->unsigned();
            $table->foreign('to_user')->references('id')->on('users');
            $table->bigInteger('from_user')->unsigned();
            $table->foreign('from_user')->references('id')->on('users');
            $table->text('room_name')->nullable();
            $table->enum('status',['1','2'])->default('1')->comment('unread, read');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_rooms');
    }
}
