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
        $textlocal = new Textlocal('abel@parableu.com', '43bc47c06f42d41c9143e31b90013be0de43ed35');
        $numbers = [$mobile];
        $sender = 'TXTLCL';
        $message = 'Thank you for registering with us. Enter this pin '.$code.' to confirm registration.';
        $response = $textlocal->sendSms($numbers, $message, $sender);
    }
}
