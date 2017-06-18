<?php

namespace App\Http\Controllers\Frontend\Member;

use Illuminate\Http\Request;

use App\Models\LocationInformation;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRequest;
use App\Models\UserNotification;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

use Image;
use Input;
use Validator;
use Sentinel;
use Hash;
use Session;
use App\Models\MailSmtp;
use Mail;
use DB;

class ProfileController extends Controller
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
    public function index()
    {
        if(!empty(user_info('date_of_birth')) ){
            $date_of_birth = Carbon::createFromFormat('Y-m-d', user_info('date_of_birth'))->format('d-m-Y');
        }else{
            $date_of_birth = '';
        }
        $queryProvince = LocationInformation::where('district_id','=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get();
            $form = [
                'url' => route('member-profile-post'),
                'class' => 'form-horizontal jquery-form-edit-profile',
                'autocomplete' => 'off',
                'files' => true,
            ];
        
        return view('frontend.member.profile.profile', compact('form'))->with('queryProvince',$queryProvince)->with('date_of_birth',$date_of_birth);
    }
    
    public function profileEdit()
    {
            $form = [
                'url' => route('profile-profile-edit-process'),
                'class' => 'form-horizontal form-bordered',
                'autocomplete' => 'off',
                'files' => true,
            ];

        return view('backend.member.profile.profile_edit', compact('form'));
    }
    public function processEditAvatar(Request $req)
    {
        $param = $req->all();
        $rules = array(
            'avatar'   => 'required|image|mimes:jpeg,jpg,png|between:0,600',
        );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
                $this->validate($req,$rules);
        } else {
                $user = User::find(user_info('id'));
                if( $req->hasFile('avatar') ){
                    if($user->avatar != ""){  
                    $image_path = public_path().'/storage/avatars/'.$user->avatar;
                    unlink($image_path);
                    }
                    createdirYmd('storage/avatars');
                    $file = Input::file('avatar');            
                    $name = str_random(20). '-' .$file->getClientOriginalName();            
                    $path = public_path().'/storage/avatars/'.date("Y")."/".date("m")."/".date("d")."/".$name;         
                                        
                    Image::make($file->getRealPath())->resize(200, 200)->save($path);
                    $user->avatar = date("Y")."/".date("m")."/".date("d")."/".$name;                     
                }else{                            
                    $user->avatar = $user->avatar;                        
                }
                $user->save();
                return 'success_edit_avatar';
        }
    }
    public function processProfileEdit(Request $req)
    {                
        Validator::extend('without_spaces', function($attr, $value){
    return preg_match('/^\S*$/u', $value);
        });
        $param = $req->all();
        $rules = array(
            'avatar'   => 'image|mimes:jpeg,jpg,png|between:0,600',
            'first_name'   => 'required',
            // 'last_name'   => 'required',
            //'email'   => 'required|email|unique:users,email',
            'address'   => 'required',
            'phone'   => 'required|numeric|digits_between:6,13',
            'gender'   => 'required',
            'province'   => 'required',
            'city'   => 'required',
            'district'   => 'required',
            'postal_code'   => 'required',
            // 'place_of_birth'   => 'required',
            'date_of_birth'   => 'required|date_format:Y-m-d',
        );
        $user = User::find(user_info('id'));

        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
                $this->validate($req,$rules);
        } else {
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                //$user->email = $req->email;
                $user->gender = $req->gender;
                $user->address = $req->address;
                $user->phone = $req->phone;
                $user->postal_code = $req->postal_code;
                $user->date_of_birth = $req->date_of_birth;
                $province_id = $req->province;
                $district_id = str_replace('/'.$province_id,'',$req->city);
                $sub_district_id = $req->district;
                $location_information_id = LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=',$sub_district_id)->where('village_id','=','0')->orderBy('name')->get()->first()->id;
                $user->location_information_id = $location_information_id;
                $user->province = LocationInformation::getLocationInformation($location_information_id,'province');
                $user->city_or_district = LocationInformation::getLocationInformation($location_information_id,'city');
                $user->sub_district = LocationInformation::getLocationInformation($location_information_id,'district');
                $url_base64 = $param['image_base64_edit'];
                if( $req->hasFile('avatar') and $url_base64 != ""){
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

                $user->save();
                return 'success_edit_profile';
        }
    }
    public function profileEditBankAccount()
    {
            $form = [
                'url' => route('member-profile-profile-edit-bank-account-process'),
                'class' => 'form-horizontal form-bordered',
                'autocomplete' => 'off',
                'files' => true,
            ];
        return view('frontend.member.profile.profile_edit_bank_account', compact('form'));
    }
    public function processProfileEditBankAccount(Request $req)
    {                
        $param = $req->all();
        $rules = array(
            'bank'   => 'required',
            'bank_account_number'   => 'required',
            'bank_branch'   => 'required',
            'account_name_holder'   => 'required',
        );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {

            return back()->withErrors($validate->messages());

        } else {

                $user = User::find(user_info('id'));
                $user->bank = $req->bank;
                $user->bank_account_number = $req->bank_account_number;
                $user->bank_branch = ucwords($req->bank_branch);
                $user->bank_clearing_code = $req->bank_clearing_code;
                $user->account_name_holder = $req->account_name_holder;

                $user->save();
          
                flash()->success('Update Data Success');
                return redirect()->route('member-profile-profile-edit-bank-account');
        }
    }
    public function changePassword()
    {
            $form = [
                'url' => route('member-profile-change-password-process'),
                'class' => 'form-horizontal form-bordered jquery-form-change-password',
                'autocomplete' => 'off',
                'files' => true,
            ];
        return view('frontend.member.profile.change_password', compact('form'));
    }
    public function processChangePassword(Request $req)
    {
     
        $valid = array(
        'password' => ('required|min: 8|confirmed')
        );
        $data = $req->all();
        $find_data = Sentinel::findRoleBySlug('member')->users()->where('id','=', user_info('id'))->first();
       
        $validate = Validator::make($data, $valid);
        
        if(Hash::check($req->old_password, User::find(user_info('id'))->password))
        {
            if($validate->fails()) {
                
                echo '<div class="alert alert-danger">';
                foreach ($validate->messages()->all() as $message) {
                    echo '<span class="text-danger">'.$message.'</span><br>';
                }
                echo '</div>';
            } else {
                $user = User::find(user_info('id'));
                $user->password = Hash::make($req->password);
                $user->save();

                echo 'success_change_password';
            }
        }else {
            echo '<div class="alert alert-danger">Old Password Wrong</div>';            
        }
    }
    public function profileCompletion()
    {
                    Session::forget('otp');
                    Session::forget('otp_code');
                    Session::forget('bank');
                    Session::forget('bank_account_number');
                    Session::forget('bank_branch');
                    Session::forget('account_name_holder');
                    Session::forget('otp_code_close_account');
                    Session::forget('close_account');
        $content_upgrade_or_downgrade_plan = '

                        <div class="row">
                            <div class="col-md-12">
                                <center><h3><span class="alternative-font">Upgrade or Downgrade Your Plan</span></h3></center>
                            </div>
                        </div>';
        $content_upgrade_or_downgrade_plan .= '
                        <div class="row">
                            <div class="pricing-table">';
        $content_bank_option = '';
        foreach (Bank::all() as $value) {                    
            $content_bank_option .= '<option value="'.$value['id'].'" data-image="'.Bank::getBank($value['id'],'image_path').'">'.$value['bank'].'</option>';
        }
        $ghost_id = plan_id('code','ghost');
        $eloqPlan = Plan::where('id','!=',$ghost_id)->orderBy('id')->get();
        foreach ($eloqPlan as $value) {
            $quotes = "'";
            if(user_info('plan_id') > $value['id']){
                $code = "downgrade_plan";
                $text_button = "Downgrade";
            }else{
                $code = "upgrade_plan";
                $text_button = "Upgrade";
            }
            if ($value['status_watermark'] != "on"){
                $status_watermark = "No";  
            }else{
                $status_watermark = "Yes";
            }
            if ($value['status_affiliate_rotation'] != "on"){
                $status_affiliate_rotation = "No";  
            }else{
                $status_affiliate_rotation = "Yes";
            }
            if(user_info('plan_id') == $value['id']){
                $current_plan = '<div class="plan-ribbon-wrapper"><div class="plan-ribbon">My Plan</div></div>';
                $button_buy = '<a class="btn btn-sm btn-primary" disabled>'.$text_button.'</a>';
            }else{
                $current_plan = '';            
                $button_buy = '<a class="btn btn-sm btn-primary" onclick="javascript:show_form_upgrade_or_downgrade_plan('.$quotes.$value['id'].$quotes.','.$quotes.$value['price'].$quotes.','.$quotes.$code.$quotes.')">'.$text_button.'</a>';
            }
        $content_upgrade_or_downgrade_plan .= '
                                <div class="col-md-4 col-sm-6">
                                    <div class="plan" style="border: 1px solid '.PlanGetColor(plan_id('code',$value['code'])).'">
                                    '.$current_plan.'
                                        <h3 style="color:#fff;background-color:'.PlanGetColor(plan_id('code',$value['code'])).'">'.$value['name'].'<span><img src="'.getPlan($value['id'],'image_path').'" class="img-responsive"></span></h3>
                                        <div class="clearfix">&nbsp;</div>
                                        <h4>'.idr_format($value['price'], 'null' ).' Coin</h4>
                                        '.$button_buy.'
                                        <ul>
                                            <li><strong>'.$value['funnel_usage'].'</strong> Funnels</li>
                                            <li><strong>'.$value['page_usage'].'</strong> Pages</li>
                                            <li class="hidden"><strong>'.$value['visitors_per_month'].'</strong> Visitors / Month</li>
                                            <li><strong>'.$value['leads_per_month'].'</strong> Leads / Month</li>
                                            <li><strong>'.$value['label_view_visitor'].'</strong> Unique Visitors / Month</li>
                                            <li> Watermark Removal <strong>'.$status_watermark.'</strong></li>
                                            <li> Affiliate Rotation <strong>'.$status_affiliate_rotation.'</strong></li>
                                        </ul>
                                    </div>
                                </div>';
        }
        $content_upgrade_or_downgrade_plan .= '
                            </div>

                        </div>';
        $items = CoinTransaction::select(DB::raw('code'))
                            ->where('user_id', user_info('id'))
                            ->distinct()
                            ->get();
            $form = [
                'url' => route('member-profile-profile-completion-process'),
                'class' => 'form-horizontal form-bordered jquery-form-edit-profile-completion',
                'autocomplete' => 'off',
                'files' => true,
            ];
        return view('frontend.member.profile.profile_completion', compact('form'))->with('content_upgrade_or_downgrade_plan',$content_upgrade_or_downgrade_plan)->with('content_bank_option',$content_bank_option)->with('items',$items);
    }
    public function processProfileCompletion(Request $req)
    {                   
        if($req->close_account == TRUE or Session::has('close_account')){
            $param = $req->all();
            $rules = array(
                'reason'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if(Session::has('otp_code_close_account')){
                if($req->close_account == FALSE){
                    if($req->otp_code == Session::get('otp_code_close_account')){;
                        $user_request = new UserRequest;
                        $user_request->user_id = user_info('id');
                        $user_request->code = 'close_account';
                        $user_request->reason = Session::get('reason');
                        $user_request->status = 'pending';
                        $user_request->save();
                        UserNotification::CreateNotification("integer",$user_request->id,'','user_request','showmodal', "EMail User : ".user_info('email'), "Immediately Doing Approval BY Email User : ".user_info('email'), "","hq-admin"); 
                        MemberArea::close_account();
                        Session::forget('reason');
                        Session::forget('otp');
                        Session::forget('otp_code_close_account');
                        Session::forget('close_account');
                        echo 'success_otp_code_close_account';
                    }else{
                        echo '<div class="alert alert-danger error_otp">Otp Code Wrong';
                    }
                }else if($req->close_account == TRUE){
                    echo 'fill_otp_code_mode';   
                }else{
                    echo 'fill_otp_code_mode';                
                }
            }else{
                    if($validate->fails()) {
                        
                        $this->validate($req,$rules);
                    } else {
                        $otp_code = MemberArea::otp_code();
                        Session::put('reason',$req->reason);
                        Session::put('otp_code_close_account',$otp_code);
                        Session::put('close_account','true');
                        Session::put('otp','true');
                        $user_data =  Sentinel::findRoleBySlug('member')->users()->where('id','=',user_info('id'))->first();
                        $find_data = $user_data->toArray();
                        $find_data['otp_code'] = $otp_code;
                        Mail::send('emails.otpcodeforcloseaccount', $find_data, function($message) use($find_data) {
                            $message->from("noreply@scoido.com", 'No-Reply');
                            $message->to($find_data['email'], $find_data['first_name'])->subject('Otp Code for Close Account to Scoido');
                        });
                        echo 'success_close_account';
                    }
            }
        }else{            
            $param = $req->all();
            $rules = array(
                'bank'   => 'required',
                'bank_account_number'   => 'required',
                'bank_branch'   => 'required',
                'account_name_holder'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if(Session::has('otp_code')){
                if($req->bank == FALSE){
                    if($req->otp_code == Session::get('otp_code')){;
                        $user = User::find(user_info('id'));
                        $user->bank = Bank::getBank(Session::get('bank'),'bank');
                        $user->bank_clearing_code = Bank::getBank(Session::get('bank'),'bank_clearing_code');
                        $user->bank_account_number = Session::get('bank_account_number');
                        $user->bank_branch = Session::get('bank_branch');
                        $user->account_name_holder = Session::get('account_name_holder');
                        $user->save();
                        Session::forget('otp');
                        Session::forget('otp_code');
                        Session::forget('bank');
                        Session::forget('bank_account_number');
                        Session::forget('bank_branch');
                        Session::forget('account_name_holder');
                        echo 'success_otp_code_edit_bank_account';
                    }else{
                        echo '<div class="alert alert-danger error_otp">Otp Code Wrong';
                    }
                }else if($req->bank == TRUE){
                    if($validate->fails()) {
                        
                        $this->validate($req,$rules);
                    } else {
                        Session::forget('bank');
                        Session::forget('bank_account_number');
                        Session::forget('bank_branch');
                        Session::forget('account_name_holder');
                        Session::put('bank',$req->bank);
                        Session::put('bank_account_number',$req->bank_account_number);
                        Session::put('bank_branch',$req->bank_branch);
                        Session::put('account_name_holder',$req->account_name_holder);
                    echo 'fill_otp_code_mode';   
                    }
                }else{
                    echo 'fill_otp_code_mode';                
                }
            }else{
                      
            }
        }
    }

    public function UploadAvatar(Request $req)
    {
        $input = $req->all();
        $url_base64 = $input['image_base64'];
        $filename = $input['filename'];
        $image_encode = $url_base64;
        $base64 = explode(",", $image_encode);
        $rest_image_ext = 'data:image/jpeg';
        if (count($base64) == 2) {
            $base64_str = $base64[1];
            $image_ext = explode(';', $base64[0]);
            $rest_image_ext = $image_ext[0];
        } else {
            $base64_str = $base64[0];
        }
        
        switch ($rest_image_ext) {
            case 'data:image/jpeg':
                $ext = '.jpg';
                break;
            case 'data:image/png':
                $ext = '.png';
                break;
            
            default:
                $ext = '.png';
                break;
        }

        $base64_str = str_replace(array(" ","-","_",","),array("+","+","/","="),$base64_str);//replace some caracter ' ','-','_',','
        $image = base64_decode($base64_str);//decode base64
        $path_destination = public_path(). DIRECTORY_SEPARATOR. 'storage'. DIRECTORY_SEPARATOR. 'avatars';
        $filename = time().$filename;
        if (! file_exists($path_destination)) {
            mkdir($path_destination, 0777, true);
        }

        $img = Image::make($image);
        $img->save($path_destination.'/'.$filename);

        $user = User::find(user_info('id'));
        $user->avatar = $filename;
        $user->save();
        
        flash()->success('Avatar successfully uploaded.');
        return redirect()->route('admin-profile');
    }
    public function post_profile(Request $request)
    {
        $response = array();
        $param = $request->all();

        $rules = array(
            'nama'   => 'required',
            'nama_panggilan'   => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'   => 'required',
            'kode_pos'   => 'required|numeric',
            // 'alamat'   => 'required',
            'sd'   => 'required',
            'smp'   => 'required',
            'sma'   => 'required',
            'universitas'   => 'required',
            'jenjang'   => 'required|not_in:Pilih Jenjang Pendidikan',
            'fakultas'   => 'required',
            'jurusan'   => 'required',
            'semester'   => 'required',
            /*'ayah'   => 'required',
            'umur_ayah'   => 'required|numeric',
            'pendidikan_terakhir_ayah'   => 'required',
            'pekerjaan_ayah'   => 'required',
            'ibu'   => 'required',
            'umur_ibu'   => 'required|numeric',
            'pendidikan_terakhir_ibu'   => 'required',
            'pekerjaan_ibu'   => 'required',*/
            'telepon'   => 'required|numeric',
            'tahun_lulus_sd'   => 'required|numeric',
            'tahun_lulus_smp'   => 'required|numeric',
            'tahun_lulus_sma'   => 'required|numeric',
            'email'   => 'required|email',
            'jenis_kelamin'   => 'required',
            /*'asrama'   => 'required|not_in:Pilih Asrama',
            'kamar'   => 'required',*/
        );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules);
        } else {
            $user_data = User::find($request->id);

            if($request->email == $user_data->email){
                $user_data->email = $user_data->email;
            }else {
                $check_email = User::where('email',$request->email)->get();
                
                if(count($check_email)>0){
                    $json = ['email' => ['The email has already been taken.']];
                    
                    return new JsonResponse($json, 422);
                }else{
                    $user_data->email = $request->email;
                }
            }

            if($request->hasFile('image')) {
                if($user_data->image != ""){
                    $image_path = public_path().'/storage/student/'.$user_data->image;
                    unlink($image_path);
                }
                createdirYmd('storage/student');
                $file = Input::file('image');
                $name = str_random(20). '-' .$file->getClientOriginalName();
                $user_data->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                $file->move(public_path().'/storage/student/'.date("Y")."/".date("m")."/".date("d")."/", $name);
            }

            $user_data->username = $request->nama;
            $user_data->first_name = $request->nama_panggilan;
            $user_data->place_of_birth = $request->tempat_lahir;
            $user_data->date_of_birth = $request->tanggal_lahir;
            $user_data->gender = $request->jenis_kelamin;
            $user_data->phone = $request->telepon;
            $user_data->postal_code = $request->kode_pos;
            $user_data->sd = $request->sd;
            $user_data->sd_th = $request->tahun_lulus_sd;
            $user_data->sltp = $request->smp;
            $user_data->sltp_th = $request->tahun_lulus_smp;
            $user_data->slta = $request->sma;
            $user_data->slta_th = $request->tahun_lulus_sma;
            $user_data->university = $request->universitas;
            $user_data->jenjang = $request->jenjang;
            $user_data->faculty = $request->fakultas;
            $user_data->major = $request->jurusan;
            $user_data->semester = $request->semester;
            $user_data->save();

            $response['notification'] = 'Data has been updated';
            $response['status'] = 'success';
        }
        echo json_encode($response);
    }
}
