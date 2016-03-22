<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdCate extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       //
       Schema::create('categories', function(Blueprint $table) {
           $table->increments('id');
           $table->string('category_name', 255);
           $table->integer('parent_id')->unsigned();
           $table->tinyInteger('level');
           $table->tinyInteger('index');
           $table->timestamps();
       });
       Schema::create('products', function(Blueprint $table) {
           $table->increments('id');
           $table->string('product_name', 255);
           $table->string('local_name', 255);
           $table->boolean('out_of_stock');
           $table->boolean('active');
           $table->integer('brand_id')->unsigned();
           $table->integer('category_id')->unsigned();
           $table->timestamps();
       });
       Schema::create('prices', function(Blueprint $table) {
           $table->increments('id');
           $table->integer('product_id')->unsigned();
           $table->integer('qty')->unsigned();
           $table->integer('unit_id')->unsigned();
           $table->integer('price')->unsigned();
           $table->timestamps();
       });
       Schema::create('mrp', function(Blueprint $table) {
           $table->increments('id');
           $table->integer('product_id')->unsigned();
           $table->integer('qty')->unsigned();
           $table->integer('unit_id')->unsigned();
           $table->integer('mrp')->unsigned();
           $table->timestamps();
       });
       Schema::create('descriptions', function(Blueprint $table) {
           $table->increments('id');
           $table->text('description');
           $table->integer('product_id')->unsigned();
           $table->timestamps();
       });
       Schema::create('brands', function(Blueprint $table) {
           $table->increments('id');
           $table->string('brand_name', 255);
           $table->timestamps();
       });
       // Schema::create('quantities', function(Blueprint $table) {
       //     $table->increments('id');
       //     $table->smallInteger('quantity')->unsigned();
       //     $table->integer('product_id')->unsigned();
       //     $table->timestamps();
       // });
       Schema::create('units', function(Blueprint $table) {
           $table->increments('id');
           $table->string('unit_name', 255);
           $table->string('shortform', 255);
           $table->timestamps();
       });
        Schema::create('images', function(Blueprint $table) {
           $table->increments('id');
           $table->string('image_name', 255);
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
       //
       Schema::drop('categories');
       Schema::drop('products');
       Schema::drop('prices');
       Schema::drop('mrp');
       Schema::drop('brands');
       Schema::drop('descriptions');
       Schema::drop('units');
       Schema::drop('images');
   }
}
