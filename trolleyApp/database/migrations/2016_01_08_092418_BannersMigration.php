<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BannersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function(Blueprint $table){
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->string('title', 255);
            $table->string('caption', 255);
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
       Schema::drop('banners');
    }
}
