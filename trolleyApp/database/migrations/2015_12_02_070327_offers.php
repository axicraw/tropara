<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Offers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('offers', function(Blueprint $table){
            $table->increments('id');
            $table->string('offer_name', 255);
            $table->text('description');
            $table->date('start');
            $table->date('end');
            $table->tinyInteger('offer_type')->unsigned();
            $table->integer('amount')->unsigned();
            $table->boolean('active');
            $table->timestamps();
        });
        Schema::create('offerables', function(Blueprint $table){
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->integer('offerable_id')->unsigned();
            $table->string('offerable_type');
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
        Schema::drop('offers');
        Schema::drop('offerables');
    }
}
