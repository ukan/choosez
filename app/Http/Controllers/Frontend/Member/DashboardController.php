<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use Sentinel;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        return view('frontend.member.dashboard.dashboard');
    }

    public function getLogout()
    {
        if(sentinel_check_role_admin()){
            $route = 'admin-login';
        }else{
            $route = 'admin-login-member';      
        }
        $idLog = DB::table('auth_logs')
                 ->where('user_id','=',user_info('id'))
                 ->max('id');
        $logs = AuthLog::find($idLog);
        if($logs){
            
        $logs->logout = date('Y-m-d H:i:s');
        $logs->save();
        }

        setcookie("isAuthorized");
        Sentinel::logout();
        return redirect()->route($route);
    }
}