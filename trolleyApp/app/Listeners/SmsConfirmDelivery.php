<?php

namespace App\Listeners;

use App\User;
use App\Area;
use Sentinel;
use App\Events\OrderDelivered;
use App\Includes\Textlocal;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SmsConfirmDelivery
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
     * @param  OrderDelivered  $event
     * @return void
     */
    public function handle(OrderDelivered $event)
    {
        //
        $user = $event->user;
        $checkout = $event->checkout;
        $total = $checkout->total;

        $area = Area::findorfail($checkout->area_id);
        // send sms
        $textlocal = new Textlocal('seekaja@yahoo.com', '0d756599c39b32baab966c65f4a1b050975394e5');
        $numbers = [$user->mobile];
        $sender = 'TROLIN';
        $message = 'Your Trolleyin order-no '.$checkout->id.' of value Rs. '.$total.' has been delivered. Thank you for your purchase.';
        //dd($message);
        $response = $textlocal->sendSms($numbers, $message, $sender);
    }
}
