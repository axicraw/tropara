<?php

namespace App\Listeners;
use DB;
use Sentinel;
use Activation;
use App\Includes\Textlocal;
use App\Events\NewRegistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SmsNewUser
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
     * @param  NewRegistration  $event
     * @return void
     */
    public function handle(NewRegistration $event)
    {
        //
        $user = $event->user; 
        $mobile = $user->mobile;
        $user = Sentinel::findById($user->id);
        // $threshold = DB::table('activations')->groupBy('user_id')->get();
        // dd(count($threshold));
        $activation = Activation::create($user);
        $code  = $activation->code;
        $username = "seekaja@yahoo.com";
        $hash = "0d756599c39b32baab966c65f4a1b050975394e5";
        $numbers = [$mobile];
        $sender = 'TROLIN';
        $test = 0;


        
        $message = 'Thank you for registering with us. Enter this pin '.$code.' to confirm registration.';

        $textlocal = new Textlocal('seekaja@yahoo.com', '0d756599c39b32baab966c65f4a1b050975394e5');
        $response = $textlocal->sendSms($numbers, $message, $sender);


    }
}
