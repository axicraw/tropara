<?php

namespace App\Listeners;

use Mail;
use App\Events\NewRegistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNewUser
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
        //dd($user);


        $data['mobile'] = $user->mobile;
        Mail::send('email.newreg', $data, function ($message) use ($user) {
                 $message->from('postmaster@sandbox832d8fcfab3c4dc6888feed3be7e49f3.mailgun.org');
                 $message->to($user->email);
        });
    }
}
