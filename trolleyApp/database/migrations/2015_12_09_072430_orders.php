<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //checkout is collection of products purchased at a time
        Schema::create('checkouts', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('address');
            $table->boolean('payment');
            $table->string('payment_type', 255);
            $table->string('status', 255);
            $table->timestamps();
            $table->integer('area_id')->unsigned();
            $table->string('deliverytime', 128);
        });

        //orders are indiv
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('checkout_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->smallInteger('nos');
            $table->string('pqty', 255);
            $table->string('offer_name', 255);
            $table->integer('offered_price')->unsigned();
            $table->string('status');
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
       Schema::drop('checkouts');
       Schema::drop('orders');
    }
}
