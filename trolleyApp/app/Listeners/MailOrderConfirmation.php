<?php

namespace App\Listeners;

use Mail;
use Log;
use App\Includes\Textlocal;
use App\Events\MadeCheckout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailOrderConfirmation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
       // $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  MadeCheckout  $event
     * @return void
     */
    public function handle(MadeCheckout $event)
    {

        Mail::send('email.orderconfirmation', [], function ($message){
             $message->from('postmaster@sandbox832d8fcfab3c4dc6888feed3be7e49f3.mailgun.org');
             $message->to('abel.yellow@gmail.com');
        });

    }
}
