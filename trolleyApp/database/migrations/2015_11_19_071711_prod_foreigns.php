<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdForeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('prices', function($table){
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::table('mrp', function($table){
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('image_product', function(Blueprint $table){
             $table->increments('id');
             $table->integer('product_id')->unsigned();
             $table->integer('image_id')->unsigned();
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
             $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });
        Schema::table('descriptions', function($table){
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        // Schema::table('quantities', function($table){
        //      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        // });
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
        Schema::table('descriptions', function($table){
             $table->dropForeign('descriptions_product_id_foreign');
        });
        Schema::table('prices', function($table){
             $table->dropForeign('prices_product_id_foreign');
        });
        Schema::table('mrp', function($table){
             $table->dropForeign('mrp_product_id_foreign');
        });
    }
}
