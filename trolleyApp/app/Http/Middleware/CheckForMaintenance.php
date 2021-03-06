<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use App\Globalset;
// use Illuminate\Contracts\Routing\Middleware;
// use Illuminate\Contracts\Foundation\Application;
// use Illuminate\Http\Request;

class CheckForMaintenance
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
        $mode = Globalset::where('name', 'maintenance')->firstorfail();
        if($mode->value == 'on'){
            return view('errors.503');   
        }
        return $next($request);
        //dd($request);
        // if ($this->app->isDownForMaintenance() && 
        //             !in_array($this->request->getClientIp(), ['86.10.190.248', '86.4.7.24']))
        // {
        //     return response('Be right back!', 503);
        // }
    }
}
