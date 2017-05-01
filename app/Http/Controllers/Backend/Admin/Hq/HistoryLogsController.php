<?php

namespace App\Http\Controllers\Backend\Admin\Hq;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\AuthLog;
use App\Models\CoinTransaction;
use App\Models\Coin;
use App\Models\Plan;
use App\Models\FunnelOrder;
use App\Models\Quota;
use Carbon\Carbon;


class HistoryLogsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $items = CoinTransaction::selectRaw('code')
                            ->distinct()
                            ->get();
        return view('backend.admin.hq.member-and-genealogy.log_history')->with('items',$items);
    }

    public function datatablesLogin(Request $request){
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = AuthLog::selectRaw('users.member_id,users.first_name,users.email, auth_logs.ip_address, auth_logs.login, auth_logs.logout,auth_logs.created_at')
                 ->leftJoin('users','users.id','=','auth_logs.user_id')
                 ->orderBy('auth_logs.id')->get();
        }else{
            $eloq = AuthLog::selectRaw('users.member_id,users.first_name,users.email, auth_logs.ip_address, auth_logs.login, auth_logs.logout,auth_logs.created_at')
                 ->leftJoin('users','users.id','=','auth_logs.user_id')
                 ->whereBetween('auth_logs.created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))
                 ->orderBy('auth_logs.id')->get();
        }

        return datatables($eloq)->make(true);
    }

    public function datatablesTransaction(Request $request)
    {
        $eloq = CoinTransaction::where('type','!=','internal');
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            if($request->filterCode == 'all'){
                
            }else{
                $eloq = $eloq->where('code','=', $request->filterCode);
            }
        }else{

            if($request->filterCode == 'all'){
                $eloq = $eloq->whereBetween('created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'));
            }else{
                $eloq = $eloq->where('code','=', $request->filterCode)->whereBetween('created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'));
            }
        }
        $eloq = $eloq->get();
         return datatables($eloq)                   
                ->editColumn('code', function ($transaction) {
                        $code = $transaction->code;
                        if(strpos($code, 'plan')){
                            $result = ucfirst(str_replace('_plan','',$code)).' '.Plan::find($transaction->plan_id)->name;
                        }else if($code == 'quota'){
                            $result = ucfirst($code).' '.ucfirst(Quota::find($transaction->quota_id)->type).' ('.Quota::find($transaction->quota_id)->number_quota.')';
                        }else{
                            $result = CoinTransaction::convert_code($code);
                        }
                        return $result;  
                })       
                ->addColumn('value', function ($transaction) {
                        $value_type = $transaction->value_type;
                        if($value_type == "coin"){
                            $result = Coin::Format($transaction->coin);
                        }else{
                            $result = coin_format($transaction->nominal);
                        }
                        return $result;  
                })       
                ->editColumn('admin_fee', function ($transaction) {    
                        return coin_format($transaction->admin_fee); 
                })       
                ->addColumn('balance', function ($transaction){    
                        return coin_format(CoinTransaction::genTotalCoinBalance($transaction->id));
                })       
                ->editColumn('payment_method', function ($transaction) {    
                        return ucwords(str_replace('_',' ',$transaction->payment_method)); 
                })       
                ->editColumn('status', function ($transaction) {
                        if($transaction->code == 'order_from_funnel'){
                            return FunnelOrder::get_data($transaction->order_id,'transaction_status');
                        }else{
                            return ucwords($transaction->status);  
                        }
                })       
                ->editColumn('created_at', function ($transaction) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $transaction->created_at)->format('d-m-Y H:i');  
                })       
                ->make(true);
    }
    public function datatablesOrder(Request $request)
    {
        $eloq = FunnelOrder::selectRaw("funnel_orders.id, funnel_orders.shipping_method_service_cost, funnel_orders.unique_digit, funnel_orders.created_at, CONCAT(billing_address_first_name, ' ', billing_address_last_name) AS full_name, funnel_orders.status,funnels.title")->leftJoin('funnels','funnels.id','=','funnel_orders.funnel_id');
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
        }else{
            $eloq = $eloq->whereBetween('funnel_orders.created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'));
        }
        $eloq = $eloq->get();
         return datatables($eloq)
                ->addColumn('value', function ($funnel_order) {
                        return idr_format(FunnelOrder::get_data($funnel_order->id,'grandtotal'));
                })
                ->editColumn('payment_method', function ($funnel_order) {
                        return ucwords(str_replace('_',' ',$funnel_order->payment_method));
                })
                ->editColumn('status', function ($funnel_order) {

                        return ucwords($funnel_order->status);
                })
                ->editColumn('created_at', function ($funnel_order) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $funnel_order->created_at)->format('d-m-Y H:i');
                })
                ->make(true);
    }
}
