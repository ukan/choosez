<?php

namespace App\Http\Controllers\Backend\Admin\Hq;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\User;
use App\Models\Role;
use App\Models\Generation;
use App\Models\BackendHqMemberNGenealogy;
use App\Models\LocationInformation;
use App\Models\UserPlanIdLog;
use App\Models\UserStatusAccountLog;
use Image;
use Input;
use Validator;
use Sentinel;
use Carbon\Carbon;
use Mail;
use Excel;
use Session;
use stdClass;
use Hash;
use DB;

class MemberNGenealogy extends BaseController
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
    public function list_member_index(Request $request,$member_id="")
    {
        $var_view = array(
            'ceo' => '',
            'member_id' => $member_id
        );

        return view('backend.admin.hq.member-and-genealogy.list_member')->with($var_view);
    }
    public function datatables_list_member(Request $request)
    {   
        if(empty($request->filter_start) or $request->filter_start == "Y-m-d"){
            $eloq = User::selectRaw("users.*,CONCAT(users.first_name,' ', users.last_name) As name, plans.name As plan_name")
                ->distinct()
                ->leftJoin('transactions','transactions.user_id','=','users.id')
                ->leftJoin('plans','plans.id','=','users.plan_id')
                ->whereHas( 'roles', function( $role ) {
                    $role->whereSlug( 'member' );
                });
            if($request->check_zero_upline == 'zero'){
                $eloq = $eloq->whereDoesntHave('Generations');
            }
            $eloq = $eloq->get();
        }else{
            $eloq = User::selectRaw("users.*,CONCAT(users.first_name,' ', users.last_name) As name, plans.name As plan_name")
                ->distinct()
                ->leftJoin('transactions','transactions.user_id','=','users.id')
                ->leftJoin('plans','plans.id','=','users.plan_id')
                ->whereBetween('users.created_at', array($request->filter_start.' 00:00:00', $request->filter_end.' 23:59:59'));
            if($request->check_zero_upline == 'zero'){
                $eloq = $eloq->whereDoesntHave('Generations');
            }
            $eloq = $eloq->whereHas( 'roles', function( $role ) {
                        $role->whereSlug( 'member' );
                    })->get();
        }     

            return datatables($eloq)        
                ->addColumn('upline_id', function ($user) {
                    $eloq = Generation::where('user_id',$user->id);
                    if($eloq->count() > 0) {
                        return User::getUser($eloq->get()->first()->upline_id,'member_id');
                    }else{
                        return '';
                    }
                })
                ->addColumn('upline_name', function ($user) {
                    $eloq = Generation::where('user_id',$user->id);
                    if($eloq->count() > 0) {
                        return User::getUser($eloq->get()->first()->upline_id,'first_name').' '.User::getUser($eloq->get()->first()->upline_id,'last_name');
                    }else{
                        return '';
                    }
                })  
                ->addColumn('mover_id', function ($user) {
                    $eloq = Generation::where('user_id',$user->id);
                    if($eloq->count() > 0) {
                        return User::getUser($eloq->get()->first()->mover_id,'member_id');
                    }else{
                        return '';
                    }
                })  
                ->addColumn('profile_completions', function ($user) {                    
                    if($user->funnels_name == '') {
                        return 'Not Completed';
                    }else{
                        return 'Completed';
                    }
                })  
                ->editColumn('status_account', function ($user) {                        
                        return ucwords(str_replace('_', ' ', $user->status_account));  
                })  
                ->editColumn('banned_by', function ($user) {                        
                        return User::getUser($user->banned_by,'name');  
                })  
                ->addColumn('action', function ($user) {
                    $statusBanned = "";
                    $statusActive = "";
                    if($user->id == User::getCeoID()){
                        $display_btn_delete = 'disabled';
                        $action_delete = '';
                    }else{
                        $display_btn_delete = '';
                        $action_delete = "javascript:show_form_delete('".$user->id."')";
                    }
                        $action_active = "javascript:execute_active('".$user->id."')";
                        $action_banned = "javascript:execute_banned('".$user->id."')";
                        $action_reset = "javascript:execute_reset('".$user->id."')";
                        $button_update_delete = '<a onclick="javascript:show_form_update('.quotes.$user->id.quotes.')" class="btn btn-success btn-xs" title="Update User"><i class="fa fa-pencil fa-fw"></i></a>
                        <a onclick="'.$action_delete.'" class="btn btn-danger btn-xs" title="Delete User" '.$display_btn_delete.'><i class="fa fa-trash-o fa-fw"></i></a> ';
                        return $user->status_account == 'active' ? 
                        $button_update_delete.'<a onclick="javascript:show_user('.quotes.$user->id.quotes.')" class="btn btn-primary btn-xs" title="Show User"><i class="fa fa-eye fa-fw"></i></a>
                        <a onclick="'.$action_banned.'" class="btn btn-danger btn-xs" id="banned" name="banned" title="Banned"><i class="fa fa-ban fa-fw"></i></a>
                        <a onclick="'.$action_reset.'" class="btn btn-warning btn-xs" id="resetPass" name="resetPass" title="Reset Password"><i class="fa fa-key fa-fw"></i></a>' : 
                        $button_update_delete.'<a onclick="javascript:show_user('.quotes.$user->id.quotes.')" class="btn btn-primary btn-xs" title="Show User"><i class="fa fa-eye fa-fw"></i></a>
                        <a onclick="'.$action_active.'" class="btn btn-success btn-xs" id="activeMember" name="activeMember" title="Active"><i class="fa fa-check-circle fa-fw"></i></a>
                        <a onclick="'.$action_reset.'" class="btn btn-warning btn-xs" id="resetPass" name="resetPass" title="Reset Password"><i class="fa fa-key fa-fw"></i></a>
                        ';
                })               
                ->make(true);
    }

    public function get_data_member(Request $request){
        
        $response = array();
        $userData = User::find($request->id);   

        $response['id'] = $userData->id;
        $response['email'] = $userData->email;
        $response['status'] = 'success';
        echo json_encode($response);   
    }

    public function post_list_member(Request $request)
    {
        $response = array();
        $action = $request->action;        
        $user_id = $request->user_id;
        if($action == "show_user"){
        }

    }
    public function forgot_password_request_index(Request $request)
    {
        $var_view = array(
            'ceo' => '',
        );
        return view('backend.admin.hq.member-and-genealogy.forgot_password_request')->with($var_view);
    }
    public function datatables_forgot_password_request(Request $request)
    {        
    }
    public function post_forgot_password_request(Request $request)
    {
    }
    public function genealogy_index(Request $request)
    {
        $ceo = Sentinel::findRoleBySlug('member')->users()->orderBy('created_at','asc')->first()->id;
        $var_view = array(
            'ceo' => $ceo,
        );

        return view('backend.admin.hq.member-and-genealogy.genealogy')->with($var_view);
    }
    public function datatables_genealogy($code,Request $request)
    {        
        $eloq = User::selectRaw("id,plan_id,CONCAT(first_name,' ', last_name) As name,member_id,status_account")->whereHas( 'roles', function( $role ) {
           $role->whereSlug( 'member' );
        } );
        if($code == 'list_member'){
            return datatables($eloq->get())       
                ->addColumn('action', function ($user) {
                    return '<a onclick="javascript:show_genealogy('.quotes.$user->id.quotes.')" class="btn btn-warning btn-xs" title="Show Genealogy"><i class="fa fa-eye fa-fw"></i></a>';
                })
                ->make(true);
        }else if($code == 'active_member'){
            $eloq = $eloq->where('status_account','=','active');            
            return datatables($eloq->get())       
                ->addColumn('action', function ($user) {
                    return '<a onclick="javascript:show_form_spillover('.quotes.$user->id.quotes.')" class="btn btn-primary btn-xs" title="Show Genealogy">Spillover</a>';
                })
                ->make(true);
        }else if($code == 'non_active_member'){
            $eloq = $eloq->where('status_account','!=','active');            
            return datatables($eloq->get())       
                ->make(true);
        }
    }

    public function post_member(Request $request){
        $response = array();
    
        if($request->action == 'active'){
            User::ActionStatus($request->id,'active',user_info('id'));
            $userData = User::find($request->id);                    
            $userData->reason_banned = '';
            $userData->banned_by = 0;
            $userData->save();                    
            $response['notification'] = "Success Active User";
            $response['status'] = "success";       
        }else if($request->action == 'delete'){     
            User::ActionDelete($request->id);
            $response['notification'] = "Success Delete User";
            $response['status'] = "success"; 
        }else if($request->action == 'banned'){            
            $response = array();
            $param = $request->all();
            $rules = array(
                'reason'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            }else{
                User::ActionStatus($request->id,'banned',user_info('id'));
                $userData = User::find($request->id);                    
                $userData->reason_banned = $request->reason;
                $userData->banned_by = user_info('id');
                $userData->save();                    
                $response['notification'] = "Success Banned User";
                $response['status'] = "success";
            }
        }else if($request->action == 'create'){ 
            $plan_id = plan_id('code','ghost');
            $param = $request->all();
                $rules = array(
                    'avatar'   => 'image|mimes:jpeg,jpg,png|between:0,600',
                    'upline'   => 'required',
                    'first_name'   => 'required',
                    'password'   => 'required',
                    'email'   => 'required|email|unique:users,email',
                    'address'   => 'required',
                    'pin_bbm'   => 'min:6',
                    'phone'   => 'required|numeric|digits_between:6,13',
                    'gender'   => 'required',
                    'province'   => 'required',
                    'city'   => 'required',
                    'district'   => 'required',
                    'postal_code'   => 'required',
                    'ktp_number'   => 'required|digits:16',
                    'ktp_photo'   => 'image|mimes:jpeg,jpg,png|between:0,600',
                    'npwp_number'   => 'digits:15',
                    'npwp_photo'   => 'image|mimes:jpeg,jpg,png|between:0,600',            
                    // 'place_of_birth'   => 'required',
                    'date_of_birth'   => 'required|date_format:Y-m-d',
                    'information'   => 'required',
                );

                $rules['ktp_photo'] = 'required|image|mimes:jpeg,jpg,png|between:0,600';
                $rules['funnels_name'] = 'required|unique:users,funnels_name';
                $validate = Validator::make($param,$rules);

                if($validate->fails()) {
                        $this->validate($request,$rules);
                } else {

                do{
                    $member_id = mt_rand(10000000, 99999999);
                } while (Sentinel::findRoleBySlug('member')->users()->where('member_id', '=', $member_id)->count() == 1);
                $upline_id = $request->upline;
                $user = [
                    'email' => $request->email,
                    'password' => $request->password,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'is_admin' => true,
                ];
                $user = Sentinel::registerAndActivate($user);
                Sentinel::findRoleBySlug('member')->users()->attach($user);
                $user = User::find($user->id);
                $user->funnels_name = strtolower(str_replace(' ','-',$request->funnels_name));
                $user->member_id = $member_id;
                $user->status_account = 'active';
                $user->plan_status = 'active';
                $user->gender = $request->gender;
                $user->date_of_birth = $request->date_of_birth;
                $user->plan_id = $plan_id;
                $user->is_completed = 0;
                $user->address = $request->address;
                $user->pin_bbm = $request->pin_bbm;
                $user->phone = $request->phone;
                $user->postal_code = $request->postal_code;
                $user->ktp_number = $request->ktp_number;
                $user->npwp_number = $request->npwp_number;    
                // $user->place_of_birth = $request->place_of_birth;
                $user->date_of_birth = $request->date_of_birth;
                $user->information = $request->information;  
                // $user->is_completed = 1;
                $province_id = $request->province;
                $district_id = str_replace('/'.$province_id,'',$request->city);
                $sub_district_id = $request->district;
                $location_information_id = LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=',$sub_district_id)->where('village_id','=','0')->orderBy('name')->get()->first()->id;
                $user->location_information_id = $location_information_id;
                $user->province = LocationInformation::getLocationInformation($location_information_id,'province');
                $user->city_or_district = LocationInformation::getLocationInformation($location_information_id,'city');
                $user->sub_district = LocationInformation::getLocationInformation($location_information_id,'district');
                $url_base64 = $param['image_base64_edit'];
                if( $request->hasFile('avatar') and $url_base64 != ""){
                    createdirYmd('storage/avatars');
                    $file = Input::file('avatar');            
                    $name = str_random(20). '-' .$file->getClientOriginalName();                     
                                        
                    // Image::make($file->getRealPath())->resize(200, 200)->save($path);
                    $user->avatar = date("Y")."/".date("m")."/".date("d")."/".$name; 

                    
                        $base64 = explode(",", $url_base64);
                        $rest_image_ext = 'data:image/jpeg';
                        if (count($base64) == 2) {
                            $base64_str = $base64[1];
                            $image_ext = explode(';', $base64[0]);
                            $rest_image_ext = $image_ext[0];
                        } else {
                            $base64_str = $base64[0];
                        }

                        $base64_str = str_replace(array(" ","-","_",","),array("+","+","/","="),$base64_str);//replace some caracter ' ','-','_',','
                        $image = base64_decode($base64_str);//decode base64
                        $path = public_path().'/storage/avatars/'.date("Y")."/".date("m")."/".date("d")."/".$name;
                        $img = Image::make($image);
                        $img->save($path);
                    
                    
                }else{                            
                    $user->avatar = $user->avatar;                        
                }

                if( $request->hasFile('ktp_photo') ){
                    createdirYmd('storage/ktp_photo');
                    $file = Input::file('ktp_photo');            
                    $name = str_random(20). '-' .$file->getClientOriginalName();            
                    $user->ktp_photo = date("Y")."/".date("m")."/".date("d")."/".$name;          
                    $file->move(public_path().'/storage/ktp_photo/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                    
                }else{                            
                    $user->ktp_photo = $user->ktp_photo;                        
                }

                if( $request->hasFile('npwp_photo') ){
                    createdirYmd('storage/npwp_photo');
                    $file = Input::file('npwp_photo');            
                    $name = str_random(20). '-' .$file->getClientOriginalName();            
                    $user->npwp_photo = date("Y")."/".date("m")."/".date("d")."/".$name;          
                    $file->move(public_path().'/storage/npwp_photo/'.date("Y")."/".date("m")."/".date("d")."/", $name);                    
                }else{                            
                    $user->npwp_photo = $user->npwp_photo;                        
                }
                // Saving to database generations ...
                
                $userstatusaccountlogs = new UserStatusAccountLog;
                $userstatusaccountlogs->user_id = $user->id;
                $userstatusaccountlogs->status_account = 'active';
                $userstatusaccountlogs->save();

                $userplanidlogs = new UserPlanIdLog;
                $userplanidlogs->user_id = $user->id;
                $userplanidlogs->plan_id = $plan_id;
                $userplanidlogs->save();

                $generations = new Generation;
                $generations->user_id = $user->id;
                $generations->upline_id = $upline_id;
                $generations->save();

                $user->save();
                $response['notification'] = "Success Create User";
                $response['status'] = "success";
                }
        }else if($request->action == 'update'){            
                $param = $request->all();
                $rules = array(
                    'avatar'   => 'image|mimes:jpeg,jpg,png|between:0,600',
                    'first_name'   => 'required',
                    // 'last_name'   => 'required',
                    //'email'   => 'required|email|unique:users,email',
                    'address'   => 'required',
                    'pin_bbm'   => 'min:6',
                    'phone'   => 'required|numeric|digits_between:6,13',
                    'gender'   => 'required',
                    'province'   => 'required',
                    'city'   => 'required',
                    'district'   => 'required',
                    'postal_code'   => 'required',
                    'ktp_number'   => 'required|digits:16',
                    'ktp_photo'   => 'image|mimes:jpeg,jpg,png|between:0,600',
                    'npwp_number'   => 'digits:15',
                    'npwp_photo'   => 'image|mimes:jpeg,jpg,png|between:0,600',            
                    // 'place_of_birth'   => 'required',
                    'date_of_birth'   => 'required|date_format:Y-m-d',
                    'information'   => 'required',
                );
                $user = User::find($request->user_id);
                if($user->ktp_photo == ''){
                    $rules['ktp_photo'] = 'required|image|mimes:jpeg,jpg,png|between:0,600';
                }
                
                if($user->funnels_name == ''){
                    $rules['funnels_name'] = 'required|unique:users,funnels_name';
                    $user->funnels_name = strtolower(str_replace(' ','-',$request->funnels_name));
                }
                $validate = Validator::make($param,$rules);
                if($validate->fails()) {
                        $this->validate($request,$rules);
                } else {
                        $user->first_name = $request->first_name;
                        $user->last_name = $request->last_name;
                        //$user->email = $request->email;
                        $user->gender = $request->gender;
                        $user->address = $request->address;
                        $user->pin_bbm = $request->pin_bbm;
                        $user->phone = $request->phone;
                        $user->postal_code = $request->postal_code;
                        $user->ktp_number = $request->ktp_number;
                        $user->npwp_number = $request->npwp_number;    
                        // $user->place_of_birth = $request->place_of_birth;
                        $user->date_of_birth = $request->date_of_birth;
                        $user->information = $request->information;  
                        // $user->is_completed = 1;
                        $province_id = $request->province;
                        $district_id = str_replace('/'.$province_id,'',$request->city);
                        $sub_district_id = $request->district;
                        $location_information_id = LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=',$sub_district_id)->where('village_id','=','0')->orderBy('name')->get()->first()->id;
                        $user->location_information_id = $location_information_id;
                        $user->province = LocationInformation::getLocationInformation($location_information_id,'province');
                        $user->city_or_district = LocationInformation::getLocationInformation($location_information_id,'city');
                        $user->sub_district = LocationInformation::getLocationInformation($location_information_id,'district');
                        $url_base64 = $param['image_base64_edit'];
                        if( $request->hasFile('avatar') and $url_base64 != ""){
                            if($user->avatar != ""){  
                            $image_path = public_path().'/storage/avatars/'.$user->avatar;
                            unlink($image_path);
                            }
                            createdirYmd('storage/avatars');
                            $file = Input::file('avatar');            
                            $name = str_random(20). '-' .$file->getClientOriginalName();                     
                                                
                            // Image::make($file->getRealPath())->resize(200, 200)->save($path);
                            $user->avatar = date("Y")."/".date("m")."/".date("d")."/".$name; 

                            
                                $base64 = explode(",", $url_base64);
                                $rest_image_ext = 'data:image/jpeg';
                                if (count($base64) == 2) {
                                    $base64_str = $base64[1];
                                    $image_ext = explode(';', $base64[0]);
                                    $rest_image_ext = $image_ext[0];
                                } else {
                                    $base64_str = $base64[0];
                                }

                                $base64_str = str_replace(array(" ","-","_",","),array("+","+","/","="),$base64_str);//replace some caracter ' ','-','_',','
                                $image = base64_decode($base64_str);//decode base64
                                $path = public_path().'/storage/avatars/'.date("Y")."/".date("m")."/".date("d")."/".$name;
                                $img = Image::make($image);
                                $img->save($path);
                            
                            
                        }else{                            
                            $user->avatar = $user->avatar;                        
                        }

                        if( $request->hasFile('ktp_photo') ){
                            if($user->ktp_photo != ""){  
                            $image_path = public_path().'/storage/ktp_photo/'.$user->ktp_photo;
                            unlink($image_path);
                            }
                            createdirYmd('storage/ktp_photo');
                            $file = Input::file('ktp_photo');            
                            $name = str_random(20). '-' .$file->getClientOriginalName();            
                            $user->ktp_photo = date("Y")."/".date("m")."/".date("d")."/".$name;          
                            $file->move(public_path().'/storage/ktp_photo/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                            
                        }else{                            
                            $user->ktp_photo = $user->ktp_photo;                        
                        }

                        if( $request->hasFile('npwp_photo') ){
                            if($user->npwp_photo != ""){  
                            $image_path = public_path().'/storage/npwp_photo/'.$user->npwp_photo;
                            unlink($image_path);
                            }
                            createdirYmd('storage/npwp_photo');
                            $file = Input::file('npwp_photo');            
                            $name = str_random(20). '-' .$file->getClientOriginalName();            
                            $user->npwp_photo = date("Y")."/".date("m")."/".date("d")."/".$name;          
                            $file->move(public_path().'/storage/npwp_photo/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                            
                        }else{                            
                            $user->npwp_photo = $user->npwp_photo;                        
                        }

                        $user->save();
                        $response['notification'] = "Success Update User";
                        $response['status'] = "success";
                }
        }else{

            $find_data = User::where('email','=', $request->email)->first();
            $find_data->forgot_token = str_random(10);
            $find_data->save();
            Mail::send('emails.instructionresetpassword', $find_data->toArray(), function($message) use($find_data) {
                $message->from("noreply@scoido.com", 'No-Reply');
                $message->to($find_data->email, $find_data->first_name)->subject('Reset Password Instruction to Scoido');
            });
            
            $response['notification'] = "Success Sent Instruction Reset password";
            $response['status'] = "success";
        }

        echo json_encode($response);
    }

    public function post_genealogy(Request $request)
    {
        $response = array();
        $action = $request->action;        
        $user_id = $request->user_id;
        if($action == "show_genealogy"){
            $content_genealogy = BackendHqMemberNGenealogy::ShowGenealogy($request);
            $response['scoido_id'] = User::getUser($request->id,'member_id');
            $response['name'] = User::getUser($request->id,'name');
            $response['content_genealogy'] = $content_genealogy;
            echo json_encode($response);
        }else if($action == "getOptionRecord"){
            $getOptionRecord = '';
            $data_squad = User::selectRaw("id,plan_id,CONCAT(first_name,' ', last_name) As name,member_id")->whereHas( 'roles', function( $role ) {
           $role->whereSlug( 'member' );
        } )->where('status_account','=','active')->where('id','!=',$request->id)->get();
            foreach($data_squad as $row){            
                $getOptionRecord .= '<option value="'.$row['id'].'">'.$row['member_id'].' - '.$row['name'].'('.User::getUser($row['id'],'plan').')</option>';
            }
            $response['getOptionRecord'] = $getOptionRecord;
            echo json_encode($response);
        }elseif ($action == "getOptionRecordTableGeneration") {
            $g1 = array_column(Generation::select('user_id')->where('upline_id',$request->upline_id)->leftJoin('users','user_id','=','users.id')->where('plan_status','active')->get()->toArray(),'user_id');
            $g2 = array_column(Generation::select('user_id')->whereIn('upline_id',$g1)->leftJoin('users','user_id','=','users.id')->where('plan_status','active')->get()->toArray(),'user_id');
            $g3 = array_column(Generation::select('user_id')->whereIn('upline_id',$g2)->leftJoin('users','user_id','=','users.id')->where('plan_status','active')->get()->toArray(),'user_id');    

            $generation_id = $request->id;
            $generation = Generation::find($generation_id);
            $spill_over_user_id = $generation->user_id;
            if($request->gen == "all"){                
                $data_squad = array_unique(array_merge($g1,$g2,$g3));                 
            }else if($request->gen == "gen_1"){
                $data_squad = $g1; 
            }else if($request->gen == "gen_2"){
                $data_squad = $g2; 
            }else if($request->gen == "gen_3"){
                $data_squad = $g3; 
            }
            $data_squad = array_diff($data_squad, array($spill_over_user_id));
            $getOptionRecordTableGeneration = '';
            foreach($data_squad as $row){            
                $user_id = $row;
                $spill_over_uplines = Generation::where('user_id',$user_id)->where('upline_id',$spill_over_user_id);
                if($user_id != $request->id or $user_id != user_info('id') or $spill_over_uplines->count() == 0){
                $getOptionRecordTableGeneration .= '<option value="'.$user_id.'">'.User::getUser($user_id,'member_id').' - '.User::getUser($user_id,'first_name').'('.User::getUser($user_id,'plan').')</option>';
                }                    
            }
            $response['getOptionRecordTableGeneration'] = $getOptionRecordTableGeneration;
            echo json_encode($response);
        }else if($action == "get-data-form-spillover"){
            $response['scoido_id'] = User::getUser($request->id,'member_id');
            $response['name'] = User::getUser($request->id,'name');
            $response['generation_id'] = Generation::where('user_id',$request->id)->get()->first()->id;
            echo json_encode($response);
        }else if($action == "move-action"){            
            $param = $request->all();
            $rules = array(
                'to_user_id'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                    $this->validate($request,$rules);
            } else {
                $generation = Generation::find($request->generation_id);
                $generation->upline_id = $request->to_user_id;
                $generation->mover_id = user_info('id');
                $generation->save();
                $response['notification'] = 'Success Move Upline ID';
                $response['status'] = 'success';
            }
            echo json_encode($response);
        }
    }
}
