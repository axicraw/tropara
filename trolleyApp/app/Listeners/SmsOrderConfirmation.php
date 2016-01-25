<?php

namespace App\Listeners;

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
        
        // send sms
        //$textlocal = new Textlocal('abel@parableu.com', '43bc47c06f42d41c9143e31b90013be0de43ed35');
        
        // $numbers = [9894616812];
        // $sender = 'TXTLCL';
        // $message = 'Trolleyin : Thankyou. Your purchse has been confirmed';
        
        // $response = $textlocal->sendSms($numbers, $message, $sender);
    }
}
