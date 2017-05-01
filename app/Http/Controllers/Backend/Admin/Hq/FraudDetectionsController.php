<?php

namespace App\Http\Controllers\Backend\Admin\Hq;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\CoinTransaction;
use App\Models\FunnelOrder;
use App\Models\User;
use App\Models\Coin;
use App\Models\Plan;
use Carbon\Carbon;
use DB;

class FraudDetectionsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fraudTransaction = DB::table('transactions')
                    ->where('fraud_status','=','yes')
                    ->select('fraud_status')->count();
        $fraudOrder = DB::table('funnel_orders')
                    ->join('transactions','funnel_orders.id','=','transactions.order_id')
                    ->where('fraud_status','=','yes')
                    ->select('fraud_status')->count();

        return view('backend.admin.hq.member-and-genealogy.fraud_detection')
                ->with('fraud_transaction', $fraudTransaction)
                ->with('fraud_order', $fraudOrder);
    }
    public function fraud_index()
    {
        $fraudTransaction = DB::table('transactions')
                    ->where('fraud_status','=','yes')
                    ->select('fraud_status')->count();
        $fraudOrder = DB::table('funnel_orders')
                    ->join('transactions','funnel_orders.id','=','transactions.order_id')
                    ->where('fraud_status','=','yes')
                    ->select('fraud_status')->count();

        return view('backend.admin.hq.member-and-genealogy.fraud_management')
                ->with('fraud_transaction', $fraudTransaction)
                ->with('fraud_order', $fraudOrder);
    }

    public function datatableUserDuplication(Request $request)
    {
        $accountNumber = "";
        $ktpNumber = "";
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $duplicateAcNumber = User::select("bank_account_number")
                     ->whereHas( 'roles', function( $role ) {
                        $role->whereSlug( 'member' );
                })
                     ->groupBy('bank_account_number')
                     ->havingRaw('COUNT(*) > 1')
                     ->get();
            foreach ($duplicateAcNumber as $value) {
                    $accountNumber .= $value->bank_account_number;
            }

            $duplicateKtpNumber = User::select("ktp_number")
                     ->whereHas( 'roles', function( $role ) {
                        $role->whereSlug( 'member' );
                })
                     ->groupBy('ktp_number')
                     ->havingRaw('COUNT(*) > 1')
                     ->get();
            foreach ($duplicateKtpNumber as $value) {
                    $ktpNumber .= $value->ktp_number;
            }

            $getArray = str_split($accountNumber,16);
            $getKtpNumber = str_split($ktpNumber,16);
            // $pieces = explode(",", $accountNumber);
            if($accountNumber != "" or $ktpNumber != ""){
                $eloq = User::selectRaw("id,member_id,CONCAT(first_name,' ', last_name) As name,email,gender,phone,city_or_district,created_at,bank_account_number")
                 ->whereHas( 'roles', function( $role ) {
                    $role->whereSlug( 'member' );
                })
                 ->whereIn('bank_account_number', $getArray)
                 ->orWhereIn('ktp_number', $getKtpNumber)
                 ->get();
            }else{
                $eloq = User::selectRaw("id,member_id,CONCAT(first_name,' ', last_name) As name,email,gender,phone,city_or_district,created_at,bank_account_number")
                 ->whereHas( 'roles', function( $role ) {
                    $role->whereSlug( 'member' );
                })
                 ->where('bank_account_number','=',$accountNumber)
                 ->orWhere('ktp_number','=',$ktpNumber)
                 ->get();
            }
        }else{
            $duplicateAcNumber = User::select("bank_account_number")
                 ->whereHas( 'roles', function( $role ) {
                    $role->whereSlug( 'member' );
            })
                 ->groupBy('bank_account_number')
                 ->havingRaw('COUNT(*) > 1')
                 ->get();
            foreach ($duplicateAcNumber as $value) {
                $accountNumber .= $value->bank_account_number;
            }
            $getArray = str_split($accountNumber,16);
            // $pieces = explode(",", $accountNumber);
            if($accountNumber != ""){
                $eloq = User::selectRaw("id,member_id,CONCAT(first_name,' ', last_name) As name,email,gender,phone,city_or_district,created_at,bank_account_number")
                 ->whereHas( 'roles', function( $role ) {
                    $role->whereSlug( 'member' );
                })
                 ->whereIn('bank_account_number', $getArray)
                 ->whereBetween('created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))
                 ->get();
            }else{
                $eloq = User::selectRaw("id,member_id,CONCAT(first_name,' ', last_name) As name,email,gender,phone,city_or_district,created_at,bank_account_number")
                 ->whereHas( 'roles', function( $role ) {
                    $role->whereSlug( 'member' );
                })
                 ->where('bank_account_number','=',$accountNumber)
                 ->whereBetween('created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))
                 ->get();
            }
        }
        return datatables($eloq)
                
                ->addColumn('action', function ($user) {

                    return '<a onclick="javascript:show_user('.quotes.$user->id.quotes.')" class="btn btn-primary btn-xs" title="Show User"><i class="fa fa-eye fa-fw"></i></a>
                    ';
                })
                ->make(true);
    }

    public function datatablesTransaction(Request $request)
    {
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = CoinTransaction::where('user_id','>','0')
            ->where('fraud_status','=','yes')
            ->get();
        }else{
            $eloq = CoinTransaction::where('user_id','>','0')->whereBetween('created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))
                ->where('fraud_status','=','yes')
                ->get();
        }
         return datatables($eloq)
                ->editColumn('code', function ($transaction) {
                        $code = $transaction->code;
                        if(strpos($code, 'plan')){
                            $result = ucfirst(str_replace('_plan','',$code)).' '.Plan::find($transaction->plan_id)->name;
                        }else if($code == 'quota'){
                            $result = ucfirst($code).' '.ucfirst(Quota::find($transaction->quota_id)->type).' ('.Quota::find($transaction->quota_id)->number_quota.')';
                        }else{
                            $result = ucwords(str_replace('_',' ',$code));
                        }
                        return $result;
                })
                ->addColumn('value', function ($transaction) {
                        $value_type = $transaction->value_type;
                        if($value_type == "coin"){
                            $result = idr_format($transaction->coin,'null');
                        }else{
                            $result = idr_format($transaction->nominal);
                        }
                        return $result;
                })
                ->editColumn('payment_method', function ($transaction) {
                        return ucwords(str_replace('_',' ',$transaction->payment_method));
                })
                ->editColumn('status', function ($transaction) {

                        return ucwords($transaction->status);
                })
                ->editColumn('created_at', function ($transaction) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $transaction->created_at)->format('d-m-Y H:i');
                })
                ->addColumn('action', function ($user) {
                        $action_edit = "javacsript:show_form_edit('".$user->id."')";

                        return
                        '
                          <a onclick="javascript:show_detail('.quotes.$user->id.quotes.')" class="btn btn-primary btn-xs" title="Show"><i class="fa fa-eye fa-fw"></i></a>
                          <a href="'.$action_edit.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        ';
                })
                ->make(true);
    }
    public function datatablesOrder(Request $request)
    {
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = FunnelOrder::selectRaw('funnel_orders.id, funnel_orders.shipping_method_service_cost, funnel_orders.unique_digit, funnel_orders.created_at, CONCAT(billing_address_first_name, billing_address_first_name) AS full_name, funnel_orders.status,funnels.title,transactions.fraud_status')
                 ->leftJoin('funnels','funnels.id','=','funnel_orders.funnel_id')
                ->join('transactions','funnel_orders.id','=','transactions.order_id')
                 ->where('fraud_status','=','yes')
                 ->get();
        }else{
            $eloq = FunnelOrder::where('funnel_id','>','0')->whereBetween('created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))
                ->where('fraud_status','=','yes')
                ->join('transactions','funnel_orders.id','=','transactions.order_id')
                ->get();
        }
         return datatables($eloq)
                ->editColumn('created_at', function ($order) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d-m-Y H:i');
                })
                /*->addColumn('action', function ($user) {
                        $statusFraud = "";
                        $statusFraud = "javascript:execute_fraud('".$user->id."')";

                        return
                        '<a href="'.$statusFraud.'" class="btn btn-danger btn-xs" id="fraud" name="fraud" title="Fraud">Fraud</a>
                        ';
                })*/
                ->make(true);
    }

    /*public function datatableAbnormalTransaction(Request $request)
    {
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = CoinTransaction::where('user_id','>','0')->get();
        }else{
            $eloq = CoinTransaction::where('user_id','>','0')->whereBetween('created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))->get();
        }
         return datatables($eloq)
                ->editColumn('code', function ($transaction) {
                        $code = $transaction->code;
                        if(strpos($code, 'plan')){
                            $result = ucfirst(str_replace('_plan','',$code)).' '.Plan::find($transaction->plan_id)->name;
                        }else if($code == 'quota'){
                            $result = ucfirst($code).' '.ucfirst(Quota::find($transaction->quota_id)->type).' ('.Quota::find($transaction->quota_id)->number_quota.')';
                        }else{
                            $result = ucwords(str_replace('_',' ',$code));
                        }
                        return $result;
                })
                ->addColumn('value', function ($transaction) {
                        $value_type = $transaction->value_type;
                        if($value_type == "coin"){
                            $result = Coin::Format($transaction->coin);
                        }else{
                            $result = idr_format($transaction->nominal);
                        }
                        return $result;
                })
                ->editColumn('payment_method', function ($transaction) {
                        return ucwords(str_replace('_',' ',$transaction->payment_method));
                })
                ->editColumn('status', function ($transaction) {

                        return ucwords($transaction->status);
                })
                ->editColumn('created_at', function ($transaction) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $transaction->created_at)->format('d-m-Y H:i');
                })
                ->make(true);
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
