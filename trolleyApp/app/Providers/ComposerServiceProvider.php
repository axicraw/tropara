<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        view()->composer(
            ['site.home', 'site.category', 'site.product', 'site.notification', 
            'site.cart', 'site.login', 'site.account', 'site.myorders', 'site.paymentmode', 
            'site.adminlogin', 'site.forgotpassword', 'site.newpassword', 'site.useractivate',
            'site.changemobile', 'site.plain', 'site.returnproduct', 'site.myorderdetail',
            'site.myreturns', 'site.contact', 'site.searchresults'], 'App\Http\ViewComposers\ProfileComposer'
        );

        // Using Closure based composers...
        view()->composer('dashboard', function ($view) {

        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}