<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_friends', function (Blueprint $table) {
            $table->timestamps();
            $table->bigInteger('friend_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            // Create foreign key for users following/friends self-referencing many to many relationship.
            $table->foreign('friend_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            
            // Create primary key for friends table.
            $table->primary(array('user_id', 'friend_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_friends');
    }
}
