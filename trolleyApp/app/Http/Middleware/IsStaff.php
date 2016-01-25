<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class IsStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($user = Sentinel::check())
        {
            if($user->hasAccess(['order.manage']))
            {
                //dd('has access');
                return $next($request);
            }
            else{
                return('You dont have the access');
            }
        }
        return redirect()->guest('/stafflogin'); 
    }
}
