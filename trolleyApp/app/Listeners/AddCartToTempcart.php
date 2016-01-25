<?php

namespace App\Listeners;

use Cart;
use App\User;
use App\Tempcart;
use App\Events\LoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddCartToTempcart
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
     * @param  LoggedIn  $event
     * @return void
     */
    public function handle(LoggedIn $event)
    {
        //
        $orders = Cart::content();
        //dd($orders);
        foreach($orders as $order)
        {
            $tempcart = Tempcart::create([
                                       'user_id' => $event->user->id,
                                       'product_id' => $order->id,
                                       'pqty_id' => $order->options->pid,
                                       'nos' => $order->qty
                                   ]);
        }

    }
}
