<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class IsAdmin
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
            if($user->hasAccess(['product.manage', 'order.manage', 'user.manage']))
            {
                return $next($request);
            }
            else{
                //dd($user);
                return('You dont have the admin access');
            }
        }
        return redirect()->route('adminlogin');
    }
}
