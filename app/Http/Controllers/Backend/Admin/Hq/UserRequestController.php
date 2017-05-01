<?php

namespace App\Http\Controllers\Backend\Admin\Hq;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\UserRequest;
use App\Models\UserNotification;
use App\Models\User;
use Input;
use Validator;
use Datatables;
use Carbon\Carbon;
class UserRequestController extends BaseController
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
            $plans = Plan::all();
            return view('backend.admin.hq.requests.index')->with('plans',$plans);
    }

   
    public function datatables(Request $request)
    {

        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = UserRequest::join('users','users.id','=','user_requests.user_id')->select(['user_requests.id','users.member_id','users.first_name','users.email','user_requests.user_id','user_requests.reason','user_requests.status','user_requests.created_at','user_requests.updated_at'])
                ;
        }else{
            $eloq = UserRequest::join('users','users.id','=','user_requests.user_id')->select(['user_requests.id','users.member_id','users.first_name','users.email','user_requests.user_id','user_requests.reason','user_requests.status','user_requests.created_at','user_requests.updated_at'])->whereBetween('user_requests.created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'))->get();
        }
        $datatables = Datatables::of($eloq)       
                ->editColumn('first_name', function ($user_request) {
                        $user = "ID : ".User::getUser($user_request->user_id,'member_id')."<br>";
                        $user .= "Name : ".User::getUser($user_request->user_id,'name')."<br>";
                        $user .= "Email : ".User::getUser($user_request->user_id,'email')."<br>";
                        $user .= "Phone : ".User::getUser($user_request->user_id,'phone')."<br>";
                        return $user;  
                })    
                ->editColumn('code', function ($user_request) {
                        if($user_request->code == 'close_account'){
                            $result = 'Account Closure';
                        }else{
                            $result = '';
                        }
                        return $result;  
                })  
                ->editColumn('status', function ($user_request) {                        
                        return ucwords(str_replace('_', ' ', $user_request->status));  
                })  
                ->editColumn('created_at', function ($user_request) {
                    return 'Created : '.Carbon::createFromFormat('Y-m-d H:i:s', $user_request->created_at)->format('M d, Y H:i').'<br>Updated : '.Carbon::createFromFormat('Y-m-d H:i:s', $user_request->updated_at)->format('M d, Y H:i');  
                })  
                
                ->addColumn('action', function ($user_request) {
                        //show_form_approval_request
                        if($user_request->status == 'pending'){
                            $btn_confirm = '<a onclick="javascript:show_form_approval_request('.quotes.$user_request->id.quotes.')" title="Confirmation" class="cursor-pointer btn btn-success btn-xs"> <i class="fa fa-check"></i></a>';
                        }else{
                            $btn_confirm = '<a title="Confirmation" class="cursor-pointer btn btn-success btn-xs" disabled> <i class="fa fa-check"></i></a>';   
                        }
                        return $btn_confirm;  
                });
            return $datatables->make(true);
    }
    public function post(Request $request){
        $response = array();
        $action = $request->action;
        $user_request = UserRequest::find($request->id);
        $user_id = $user_request->user_id;
        if($action == "get-data"){        
            $response['id'] = $user_request->id;
            $response['code'] = $user_request->code;           
        }else if($action == "approval_request"){
            if($request->status == 'approved'){                
                if($request->code == "close_account"){
                    User::ActionStatus($user_id,'account_closure');                
                }
                $user_request->status = 'approved';
                $user_request->save();
                $response['notification'] = 'Request Has Been Accepted';
                $response['status'] = 'success';
            }else{
                UserNotification::CreateNotification("integer",$user_request->id,$user_id,'user_request','showmodal', "Approval", "Sorry, Your request has been rejected<br> Code : ".ucwords(str_replace('_', ' ', $user_request->code))."<br>Your Reason : ".$user_request->reason, "member");
                $user_request->status = 'not_approved';
                $user_request->save();
                $response['notification'] = 'Request Has Been Rejected';
                $response['status'] = 'success';
            }
        }
        echo json_encode($response);
    }
}