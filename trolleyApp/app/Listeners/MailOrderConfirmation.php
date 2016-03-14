<?php

namespace App\Listeners;

use Mail;
use Log;
use DB;
use Sentinel;
use App\Order;
use App\User;
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

        $user = $event->user;
        $checkout = $event->checkout;

        $orders = Order::with('product')->where('checkout_id', $checkout->id)->get();
        $admin = Sentinel::findRoleBySlug('admin');
        $admins =  $admin->users()->get();
        $admin_emails = [];
        foreach($admins as $admin)
        {
            array_push($admin_emails, $admin->email);
        }

        $data = [
            'orders' => $orders,
            'user' => $user
        ];
        //dd($data);
        Mail::send('email.orderconfirmation', $data, function ($message) use ($user){
             $message->from('care@trolleyin.com', $name="Trolleyin");
             $message->subject('Trolleyin.com Order Confirmation');
             $message->to($user->email);
        });
        foreach ($admin_emails as $email) {
            Mail::send('email.admin.orderconfirmation', $data, function ($message) use($email){
                $message->from('admin@trolleyin.com');
                $message->subject('New Order Placed');
                $message->to($email);
            });
        }
        

    }
}
