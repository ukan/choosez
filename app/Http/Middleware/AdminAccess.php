<?php

namespace App\Http\Middleware;

use Route;
use Redirect;
use Closure;
use General;
use Sentinel;
use Request;
use URL;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string    $permission
     * @return mixed
     */
    
    public function handle($request, Closure $next, $permission='')
    {
        if(Sentinel::check()){

        }else{
            return Redirect::route('admin-login');
        }

        return $next($request);

    }
}
