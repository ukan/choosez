<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;

use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserRequest;
use App\Models\Funnel;
use App\Models\FunnelOrder;
use App\Models\CoinOrder;
use App\Models\CoinTransaction;
use Input;
use Image;
use Validator;
use DB;
use Carbon\Carbon;
use Mail;
use URL;

class UserNotificationsController extends Controller
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
    public function index($slug="")
    {
        return view('backend.admin.user-notifications.index');
    }

    
    public function datatables(Request $request)
    {
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = UserNotification::where('user_id',user_info('id'))->get();
        }else{
            $eloq = UserNotification::where('user_id',user_info('id'))->whereBetween('created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))->get();
        }
         return datatables($eloq)       
                ->editColumn('content', function ($user_notification) {
                        
                        return $user_notification->content;  
                })  
                ->make(true);
    }

    public function post(Request $request)
    {   
        $response = array();
        $action = $request->action;
        if($action == "get-data"){        
            $user_notification = UserNotification::find($request->id);
            $response['id'] = $user_notification->id;
            if($user_notification->type == 'showmodal'){
                if($user_notification->code == 'user_request'){
                    if(UserRequest::where('id',$user_notification->integer_key)->count() > 0 )
                    {
                        $user_request = UserRequest::find($user_notification->integer_key);
                        
                        $response['name'] = $user_notification->name;
                        $response['content'] = '<center>'.$user_notification->content.'<br>Reason : '.$user_request->reason.'<br>
                        Please Check Request On <a href="'.route('admin-index-list-member',User::getUser($user_request->user_id,'member_id')).'">User Request Table</a></center>';
                        
                    }
                }else if($user_notification->code == 'funnel_order_confirmation_success'){
                    if(FunnelOrder::where('id',$user_notification->string_key)->count() > 0 )
                    {
                        $funnel_order = FunnelOrder::find($user_notification->string_key);
                        
                        $response['name'] = $user_notification->name;
                        $response['content'] = '<center>'.$user_notification->content.'<br>
                        Please Check Order And Choose List Funnel Order On <a href="'.route('admin-finance-order-management-funnel-orders',$funnel_order->id).'">Order List Table</a></center>';                        
                    }
                }else if($user_notification->code == 'coin_order_confirmation_success'){
                    if(CoinOrder::where('id',$user_notification->string_key)->count() > 0 )
                    {
                        $coin_order = CoinOrder::find($user_notification->string_key);
                        
                        $response['name'] = $user_notification->name;
                        $response['content'] = '<center>'.$user_notification->content.'<br>
                        Please Check Order And Choose List Coin Order On <a href="'.route('admin-finance-order-management-coin-orders',$coin_order->id).'">Order List Table</a></center>';
                        
                    }
                }else if($user_notification->code == 'withdrawal_request'){
                    if(CoinTransaction::where('order_id',$user_notification->string_key)->count() > 0 )
                    {
                        $response['name'] = $user_notification->name;
                        $response['content'] = '<center>'.$user_notification->content.'<br>
                        Please Check Withdrawal Request On <a href="'.route('admin-index-coin-management-withdrawal').'/'.$user_notification->string_key.'">Withdrawal Request Table</a></center>';
                        
                    }
                }else if($user_notification->code == 'fraud'){
                    if(CoinTransaction::where('order_id',$user_notification->string_key)->count() > 0 )
                    {
                        $response['name'] = $user_notification->name;
                        $response['content'] = '<center>'.$user_notification->content.'<br>
                        Please Check Transaction On <a href="'.route('admin-finance-order-management-transactions').'/'.$user_notification->string_key.'">Transactions Table</a></center>';
                        
                    }
                }else if($user_notification->code == 'refund'){
                    if(CoinTransaction::where('order_id',$user_notification->string_key)->count() > 0 )
                    {
                        $response['name'] = $user_notification->name;
                        $response['content'] = '<center>'.$user_notification->content.'<br>
                        Please Check Transaction On <a href="'.route('admin-finance-order-management-transactions').'/'.$user_notification->string_key.'">Transactions Table</a></center>';
                        
                    }
                }else{                    
                        $response['name'] = $user_notification->name;
                        $response['content'] = '<center>'.$user_notification->content.'</center>';
                }
            }
        }
        echo json_encode($response);            
    }
}
