<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GlobalSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('deliverytime', function(Blueprint $table){  
            $table->increments('id');
            $table->dateTime('from');
            $table->dateTime('to');
        });

        Schema::create('voidsearches', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->string('keyword', 255);
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
        Schema::drop('deliverytime');
        Schema::drop('voidsearches');
    }
}
