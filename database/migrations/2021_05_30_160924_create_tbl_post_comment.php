<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPostComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_post_comment', function (Blueprint $table) {
            $table->Increments('id');
            $table->text('content');
            $table->unsignedInteger('post_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('reply_id')->unsigned()->nullable();

            $table->foreign('post_id')
                  ->references('id')
                  ->on('tbl_post')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
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
        Schema::dropIfExists('tbl_post_comment');
    }
}
