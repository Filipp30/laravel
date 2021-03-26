<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatWaitingListsTable extends Migration
{

    public function up()
    {
        Schema::create('chat_waiting_list', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('session')->nullable(false);
            $table->timestamp('created_at');
        });
    }


    public function down()
    {
        Schema::dropIfExists('chat_waiting_list');
    }
}
