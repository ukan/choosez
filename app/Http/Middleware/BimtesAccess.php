<?php

namespace App\Http\Middleware;

use Route;
use Redirect;
use Closure;
use General;
use Sentinel;
use Request;
use App\Models\BimtesRegister;

class BimtesAccess
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
        $user_id = user_info('id');
        $user = BimtesRegister::find($user_id);
        if(Sentinel::check()){
            
        }else{
            return Redirect::route('admin-login-member');
        }
        if (sentinel_check_role_admin()) {
            return Redirect::route('admin-dashboard');
        }

        // if ($user->is_completed == 0) {
        //     $permission = Request::segment(1);
        //     if ($permission == 'funnels') {
        //         return Redirect::route('admin-dashboard-member');
        //     }
        // }

        return $next($request);

    }
}
