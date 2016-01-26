<?php

namespace App\Listeners;
use Hash;
use Sentinel;
use App\User;
use App\Events\SocialLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckSocialLogin
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
     * @param  SocialLogin  $event
     * @return void
     */
    public function handle(SocialLogin $event)
    {
        //
        $user_cred = $event->user_cred;
        dd($user_cred);
        $input = ['social_id'=>$user_cred['social_id'], 'type' => $user_cred['type']];
        $user = User::where('social_id', $user_cred['social_id'])
                        ->where('type', $user_cred['type'])->first();
        //dd($user);

        if($user)
        {
            //user exists so login
            return $user;
        }
        else 
        {
            //dd('user not found');
            $user_cred['password'] = Hash::make(str_random(8));

            $user = Sentinel::registerAndActivate($user_cred);
            $user->social_id = $user_cred['social_id'];
            $user->name = $user_cred['name'];
            $user->type = $user_cred['type'];
            $user->active = 1;
            $user->cod = 1;
            $user->save();
            
            $role = Sentinel::findRoleBySlug('customer');
            $role->users()->attach($user);
            return $user;
            //dd($user);
            //register and login

        }


        //check whether user exists

        //else create account

        //login
    }
}
