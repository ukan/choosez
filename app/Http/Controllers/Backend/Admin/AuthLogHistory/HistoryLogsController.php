<?php

namespace App\Http\Controllers\Backend\Admin\AuthLogHistory;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\AuthLog;
use App\Models\AuthLogMos;
use Carbon\Carbon;


class HistoryLogsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('backend.admin.log-history.log_history');
    }

    public function indexMos(){
        return view('backend.admin.mos.log_history');
    }

    public function datatablesLogin(Request $request){
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = AuthLog::selectRaw('users.username,users.email, auth_logs.ip_address, auth_logs.login, auth_logs.logout,auth_logs.created_at,auth_logs.updated_at')
                 ->leftJoin('users','users.id','=','auth_logs.user_id')
                 ->where('email','!=','superadmin@alihsan.com')
                 ->orderBy('auth_logs.id')->get();
        }else{
            $eloq = AuthLog::selectRaw('users.username,users.email, auth_logs.ip_address, auth_logs.login, auth_logs.logout,auth_logs.created_at,auth_logs.updated_at')
                 ->leftJoin('users','users.id','=','auth_logs.user_id')
                 ->where('email','!=','superadmin@alihsan.com')
                 ->whereBetween('auth_logs.login', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))
                 ->orderBy('auth_logs.id')->get();
        }

        return datatables($eloq)
                ->editColumn('login', function ($authLog) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $authLog->login)->setTimezone('+7');  
                })
                ->editColumn('logout', function ($authLog) {
                    if(!empty($authLog->logout))
                        return Carbon::createFromFormat('Y-m-d H:i:s', $authLog->logout)->setTimezone('+7');  
                })
                ->make(true);
    }

    public function datatablesLoginMos(Request $request){
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = AuthLogMos::selectRaw('mos.name,mos.email, auth_log_mos.ip_address, auth_log_mos.login, auth_log_mos.logout,auth_log_mos.created_at,auth_log_mos.updated_at')
                 ->leftJoin('mos','mos.id','=','auth_log_mos.mos_register_id')
                 ->orderBy('auth_log_mos.updated_at','desc')->get();
        }else{
            $eloq = AuthLogMos::selectRaw('mos.name,mos.email, auth_log_mos.ip_address, auth_log_mos.login, auth_log_mos.logout,auth_log_mos.created_at,auth_log_mos.updated_at')
                 ->leftJoin('mos','mos.id','=','auth_log_mos.mos_register_id')
                 ->whereBetween('auth_logs.login', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))
                 ->orderBy('auth_log_mos.updated_at','desc')->get();
        }

        return datatables($eloq)
                ->editColumn('login', function ($authLog) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $authLog->login)->setTimezone('+7');  
                })
                ->editColumn('logout', function ($authLog) {
                    if(!empty($authLog->logout))
                        return Carbon::createFromFormat('Y-m-d H:i:s', $authLog->logout)->setTimezone('+7');  
                })
                ->make(true);
    }
}
