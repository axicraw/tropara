<?php

namespace App\Listeners;

use Activation;
use App\User;
use App\Events\ResendPin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResendPinSms
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
     * @param  ResendPin  $event
     * @return void
     */
    public function handle(ResendPin $event)
    {
        //

        $user = $event->user; 
        //dd($user);
        $mobile = $user->mobile;
        $activation = Activation::create($user);
        $code  = $activation->code;
        // $textlocal = new Textlocal('abel@parableu.com', '43bc47c06f42d41c9143e31b90013be0de43ed35');
        // $numbers = [$mobile];
        // $sender = 'TXTLCL';
        // $message = 'Thank you for registering with us. Enter this pin '.$code.' to confirm registration.';
        // $response = $textlocal->sendSms($numbers, $message, $sender);
    }
}
