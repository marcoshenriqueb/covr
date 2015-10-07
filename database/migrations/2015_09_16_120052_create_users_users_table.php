<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersUsersTable extends Migration
{
    private $fillabel = ['user_id', 'friend_id', 'confirmed'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users_users', function (Blueprint $table) {
          $table->integer('user_id')->unsigned();
          $table->integer('friend_id')->unsigned();
          $table->boolean('confirmed')->default(0);
          $table->timestamps();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
          $table->primary(['user_id', 'friend_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_users');
    }
}
