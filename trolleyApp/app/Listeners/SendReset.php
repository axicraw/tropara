<?php

namespace App\Listeners;

use Mail;
use Log;
use App\Resettoken;;
use App\Events\ForgotPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReset
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
     * @param  ForgotPassword  $event
     * @return void
     */
    public function handle(ForgotPassword $event)
    {
        //
            $user = $event->user;
            //dd($user);
            $token = new Resettoken;
            $token->user_id = $user->id;
            $token->token = str_random(20);
            $token->save();

            $data['url'] = url('/resetpassword/?token='.$token->token);
            Mail::send('email.reset', $data, function ($message) use ($user) {
                     $message->from('postmaster@sandbox832d8fcfab3c4dc6888feed3be7e49f3.mailgun.org');
                     $message->to($user->email);
            });
    }
}
