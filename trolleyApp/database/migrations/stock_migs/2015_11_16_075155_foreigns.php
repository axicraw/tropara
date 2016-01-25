<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Foreigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('image_product', function(Blueprint $table){
             $table->increments('id');
             $table->integer('product_id')->unsigned();
             $table->integer('image_id')->unsigned();
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
             $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

       Schema::drop('image_product');
    }
}
