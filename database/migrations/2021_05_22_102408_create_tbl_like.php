<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_like', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedInteger('post_id')->unsigned();
            $table->timestamps();

            $table->foreign('post_id')
                  ->references('id')
                  ->on('tbl_post')
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
        Schema::dropIfExists('tbl_like');
    }
}
