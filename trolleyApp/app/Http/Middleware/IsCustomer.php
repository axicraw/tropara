<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class IsCustomer
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
        //dd($request->path());
        if($user = Sentinel::check())
        {
            if($user->hasAccess(['product.purchase']))
            {
                //dd('has access');
                return $next($request);
            }
            else{
                return redirect()->guest('/login'); 
            }
        }
        return redirect()->guest('/login'); 

    }
}
