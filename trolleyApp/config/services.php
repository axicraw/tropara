<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '522328167946919',
        'client_secret' => '77aec6847816eafe3e3013709080eb30',
        'redirect' => 'http://trolleyin.com/authsocial/facebook/callback',
    ],
    'twitter' => [
        'client_id' => '522328167946919',
        'client_secret' => '77aec6847816eafe3e3013709080eb30',
        'redirect' => 'http://trolleyin.com/authsocial/twitter/callback',
    ],
    'google' => [
        'client_id' => '731877718949-6qeq0c251rv0mtsudid5u0lii9m096l4.apps.googleusercontent.com',
        'client_secret' => '779fMU_nvDRswiQMlB2W7GXa',
        'redirect' => 'http://trolleyin.com/authsocial/google/callback',
    ],

];
