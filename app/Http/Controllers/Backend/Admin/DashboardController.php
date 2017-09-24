<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackendFinanceDashboard;
use App\Models\BackendHqDashboard;
use App\Models\BackendSupportDashboard;
use App\Models\User;
use App\Models\Plan;
use App\Models\Roles;
use App\Models\BankAccount;
use App\Models\UserPlanIdLog;
use App\Models\UserStatusAccountLog;
use Input;
use Carbon\Carbon;

use Sentinel;
use Mail;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('sentinel_access:dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code='year',$code2='')
    {
        if($code == '' and $code2 == ''){
            $code = date('Y');            
            $code2 = date('m');            
        }
        if(user_info('role')->slug == 'finance-admin'){            
            return BackendFinanceDashboard::Index();
        }else if(user_info('role')->slug == 'support-admin'){
            return BackendSupportDashboard::Index($code);
        }else if(user_info('role')->slug == 'hq-admin'){     
            return BackendHqDashboard::Index($code);
        }else{
            return view('backend.admin.dashboard.dashboard');
        }
    }
    public function DatatablesFinanceDashboardTransaction(Request $request)
    {        
        return BackendFinanceDashboard::DatatablesFinanceDashboardTransaction($request);
    }
    public function DatatablesHqDashboardHallOfFame(Request $request,$code="",$year="")
    {        
        $year = date('Y');
        return BackendHqDashboard::DatatablesHqDashboardHallOfFame($request,$code,$year);
    }
    public function DatatablesHqDashboardOrder(Request $request,$code="",$start_date="",$end_date="")
    {        
        return BackendHqDashboard::DatatablesHqDashboardOrder($request,$code,$start_date,$end_date);
    }
    public function DatatablesHqDashboardWithdrawalRequest(Request $request)
    {        
        return BackendHqDashboard::DatatablesHqDashboardWithdrawalRequest($request);
    }
    public function AjaxPaginationBulletinBoard(Request $request)
    {   

        return BackendHqDashboard::AjaxPaginationBulletinBoard($request);
          
    }
    public function HqDashboardPost(Request $request)
    {        
        $year = $request->year;
        $method = $request->method;
        $action = $request->action;        
        $user_id = $request->user_id;
        if($method == "show_generation"){
            BackendHqDashboard::ShowGeneration($user_id,$year);
        }else if($action == "show_order_details"){
            BackendHqDashboard::OrderDetail($request);
        }else if($action == "show_user_details"){
            BackendHqDashboard::ShowUser($user_id);    
        }else if($action == "show_user_option"){
            BackendHqDashboard::ShowUserOption();         
        }else if($action == "show_provice_option"){
            BackendHqDashboard::ShowProvinceOption();        
        }else if($action == "show_order_overview_table"){
            BackendHqDashboard::ShowOrderOverviewTable($request);      
        }else if($action == "show_order_overview_chart"){
            return BackendHqDashboard::ShowOrderOverviewChart($request);
        }else if($action == "show_withdrawal_overview_table"){
            BackendHqDashboard::ShowWithdrawalOverviewTable($request);   
        }else if($action == "show_withdrawal_overview_chart"){
            return BackendHqDashboard::ShowWithdrawalChart($request);            
        }
    }

    public function sendEmail()
    {
        $start_time = time();
        
        while(true) {
            if ((time() - $start_time) > 10) {
                $data = Sentinel::getUser()->first_name;
                $find_data['email'] = "x";
                $find_data['id'] = "cek";
                $find_data['full_name'] = $data;
                $find_data['table'] = "Create Bulletin";

                Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                    $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                                    $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                });
              return back(); // timeout, function took longer than 300 seconds
            }
            // Other processing
        }

        return back();
    }
}