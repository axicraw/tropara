<?php

namespace App\Listeners;

use DB;
use App\Order;
use App\Product;
use App\Events\MadeCheckout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddSalesStats
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
     * @param  MadeCheckout  $event
     * @return void
     */
    public function handle(MadeCheckout $event)
    {
        //
        $user  = $event->user;
        $checkout = $event->checkout;
        $orders = Order::where('checkout_id', $checkout->id)->get();

        $stats = [];

        foreach($orders as $order)
        {
            array_push($stats,[
                'user_id' => $user->id,
                'product_id' => $order->product_id
            ]);
        }
        $sales = DB::table('salesstats')->insert($stats);
    }
}
