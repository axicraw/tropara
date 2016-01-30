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
                 $message->from('welcome@trolleyin.com');
                 $message->to($user->email);
        });
    }
}
