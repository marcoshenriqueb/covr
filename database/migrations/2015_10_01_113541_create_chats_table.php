<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic')->nullable();
            $table->integer('user_1')->unsigned();
            $table->integer('user_2')->unsigned();
            $table->foreign('user_1')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_2')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_1','user_2']);
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
        Schema::drop('chats');
    }
}
