<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_item', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('detail_id')->unsigned();
            $table->integer('quantity');
            $table->integer('order_id')->unsigned();


            $table->foreign('order_id')
                  ->references('order_id')
                  ->on('tbl_order')
                  ->onDelete('cascade');
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('tbl_product');
            $table->foreign('detail_id')
                  ->references('detail_id')
                  ->on('tbl_product_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_order_item');
    }
}
