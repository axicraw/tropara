<?php

namespace App\Listeners;

use App\User;
use App\Area;
use Sentinel;
use App\Events\MadeCheckout;
use App\Includes\Textlocal;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SmsOrderConfirmation
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
        $user = $event->user;
        $checkout = $event->checkout;

        $area = Area::findorfail($checkout->area_id);
        // send sms
        $textlocal = new Textlocal('seekaja@yahoo.com', '0d756599c39b32baab966c65f4a1b050975394e5');
        $numbers = [$user->mobile];
        $sender = 'TROLIN';
        $message = 'Thankyou for your purchase in Trolleyin. Your order has been confirmed. You Order id is '.$checkout->id;
        //$response = $textlocal->sendSms($numbers, $message, $sender);

        //admin sms
        $admin = Sentinel::findRoleBySlug('admin');
        $admins =  $admin->users()->get();
        $admin_numbers = [];
        foreach($admins as $admin)
        {
            array_push($admin_numbers, $admin->mobile);
        }
        
        //dd($admins);
        $sender = 'TROLIN';
        $message = 'OrderNo '.$checkout->id.' Area '.$area->area_name.'. CMobile '.$user->mobile;
        //$response = $textlocal->sendSms($admin_numbers, $message, $sender);
    }
}
