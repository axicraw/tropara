<?php

namespace App\Listeners;

use App\User;
use App\Area;
use Sentinel;
use App\Events\MadeCheckout;
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
        // $textlocal = new Textlocal('abel@parableu.com', '43bc47c06f42d41c9143e31b90013be0de43ed35');
        // $numbers = [$user->mobile];
        // $sender = 'TXTLCL';
        // $message = 'Trolleyin : Thankyou for purchase. Your order has been confirmed';
        // $response = $textlocal->sendSms($numbers, $message, $sender);

        //admin sms
        $admin = Sentinel::findRoleBySlug('admin');
        $admins =  $admin->users()->get();
        $admin_numbers = [];
        foreach($admins as $admin)
        {
            array_push($admin_numbers, $admin->mobile);
        }
        
        // $sender = 'TXTLCL';
        // $message = 'OrderNo:'.$checkout->id.'. Area:'.$area->area_name.'. CMobile: '.$user->mobile;
        // $response = $textlocal->sendSms($numbers, $message, $sender);
    }
}
