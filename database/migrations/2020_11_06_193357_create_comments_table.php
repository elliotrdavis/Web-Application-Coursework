<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body');
            $table->timestamps();

        // Assign post id for relationship with page.
        $table->bigInteger('post_id')->unsigned();
        $table->bigInteger('user_id')->unsigned();

        // Create foreign key for post and page one-many relationship.
        $table->foreign('post_id')->references('id')->on('posts')
            ->onDelete('cascade')->onUpdate('cascade');
    
        // Create foreign keys for comment and user one-many relationship
        $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
