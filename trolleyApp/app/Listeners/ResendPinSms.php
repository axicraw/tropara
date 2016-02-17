<?php

namespace App\Listeners;

use Activation;
use App\User;
use App\Events\ResendPin;
use App\Includes\Textlocal;
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


        $numbers = [$mobile];
        $sender = 'TROLIN';
        $test = 0;

        
        $message = 'Thank you for registering with us. Enter this pin '.$code.' to confirm registration.';

        $textlocal = new Textlocal('seekaja@yahoo.com', '0d756599c39b32baab966c65f4a1b050975394e5');
        $response = $textlocal->sendSms($numbers, $message, $sender);
    }
}
