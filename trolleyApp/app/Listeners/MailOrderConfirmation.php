<?php

namespace App\Listeners;

use Mail;
use Log;
use DB;
use Sentinel;
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

        $adminids = DB::role_users()->where('role_id', 1)->get();
        $admins = User::whereIn('id', $adminids->user_id)->get();
        Mail::send('email.orderconfirmation', [], function ($message){
             $message->from('care@trolleyin.com');
             $message->to($user->email);
        });
        foreach ($admins as $admin) {
            Mail::send('email.admin.orderconfirmation', [], function ($message){
                $message->from('admin@trolleyin.com');
                $message->to($admin->email);
            });
        }
        

    }
}
