<?php

namespace App\Listeners;

use DB;
use App\Events\ProductViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddViewStats
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductViewed  $event
     * @return void
     */
    public function handle(ProductViewed $event)
    {
        //
        $sales = DB::table('viewstats')->insert(['user_id'=>$event->user_id, 'product_id'=>$event->product_id]);
    }
}
