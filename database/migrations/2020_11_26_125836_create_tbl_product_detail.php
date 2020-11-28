<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product_detail', function (Blueprint $table) {
            
            $table->Increments('detail_id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('tbl_product')
                  ->onDelete('cascade');
            $table->text('product_size');
            $table->integer('product_amount');
            $table->integer('product_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_product_detail');
    }
}
