<?php

namespace App\Listeners;

use App\Order;
use App\Tempcart;
use App\Events\MadeCheckout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveTempcart
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
        $user = $event->user;
        $checkout = $event->checkout;
        //dd($checkout);
        $orders = Order::where('checkout_id', $checkout->id)->get();
        foreach ($orders as $order) {
            Tempcart::where('user_id', $user->id)
                    ->where('product_id', $order->product_id)
                    ->delete();
        }
    }
}
