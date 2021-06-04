<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLikeComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_like_comment', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedInteger('comment_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('comment_id')
                  ->references('id')
                  ->on('tbl_post_comment')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_like_comment');
    }
}
