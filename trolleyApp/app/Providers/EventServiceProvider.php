<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\AddToCart' => [
            'App\Listeners\MakeNewOrder',
        ],
        'App\Events\MadeCheckout' => [
            'App\Listeners\MailOrderConfirmation',
            'App\Listeners\SmsOrderConfirmation',
            'App\Listeners\RemoveTempcart',
            'App\Listeners\AddSalesStats'
        ],
        'App\Events\SocialLogin' => [
            'App\Listeners\CheckSocialLogin',
        ],
        'App\Events\NewRegistration'=>[
            'App\Listeners\MailNewUser',
            'App\Listeners\SmsNewUser',
        ],
        'App\Events\VoidSearch'=>[
            'App\Listeners\StoreVoidSearch',
        ],
        'App\Events\LoggedIn'=>[
            'App\Listeners\AddCartToTempcart'
        ],
        'App\Events\ForgotPassword'=>[
            'App\Listeners\SendReset'
        ],
        'App\Events\ProductViewed'=>[
            'App\Listeners\AddViewStats'
        ]

    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
