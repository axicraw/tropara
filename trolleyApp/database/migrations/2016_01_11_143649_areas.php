<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Areas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('areas', function(Blueprint $table){
            $table->increments('id');
            $table->string('area_name', 255);
            $table->integer('delivery_cost');
            $table->integer('city_id');
            $table->boolean('deliverable');
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
        Schema::drop('areas');
    }
}
