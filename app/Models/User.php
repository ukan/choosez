<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Sentinel;
use DB;
use Cartalyst\Sentinel\Users\EloquentUser as Model;
use Mail;
use Reminder;
use Carbon\Carbon;
use App\Models\AuthLog;

use GuzzleHttp\Client;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * Default password.
     *
     * @var string
     */
    const DEFAULT_PASSWORD = '12345678';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'email', 
        'password', 
        'permissions', 
        'first_name', 
        'username', 
        'image', 
        'is_admin', 
        'phone', 
        'address',
        'place_of_birth',
        'date_of_birth',
        'rt',
        'rw',
        'village',
        'city_or_district',
        'sub_district',
        'province',
        'postal_code',
        'sd',
        'sd_th',
        'sltp',
        'sltp_th',
        'slta',
        'slta_th',
        'mbs',
        'university',
        'faculty',
        'major',
        'semester',
        'father_name',
        'fahter_age',
        'f_last_study',
        'f_current_job',
        'mother_name',
        'mother_age',
        'm_last_study',
        'm_current_job',
        'gender',
        'hostel',
        'room',
    ];

    /**
     * {@inheritDoc}
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Return user's query for Datatables.
     *
     * @param  bool|null $isAdmin
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables($isAdmin = null)
    {
        return static::select(
            'users.id',
            'users.username',
            'users.email',
            'users.username',
            'users.first_name',
            'users.is_admin',
            'roles.name as role',
            'users.last_login',
            'users.phone'
        )
        ->join('role_users', 'role_users.user_id', '=', 'users.id')
        ->join('roles', 'role_users.role_id', '=', 'roles.id');

        return $return;
    }

    public function RoleUsers(){
        return $this->belongsToMany('App\Models\Role','role_users','user_id');
    }

    public function createNewUser($data,$type = null,$role = null)
    {
        DB::beginTransaction();//begin transaction
        try{

            $credentials = [
                'email'    => $data['email'],
                'password' => $data['password'],
            ];

            $user = Sentinel::register($credentials);

            if(empty($role)) {
                $role = 'user';
            }

            Sentinel::findRoleBySlug($role)->users()->attach(Sentinel::findById($user->id));

            $activation = \Activation::create($user);

            $updateUser = $this->find($user->id);
            $updateUser->username = $data['username'];

            if($type == 'from_admin') {
                \Activation::complete($user, $activation->code);
                $data_email = array('id'=>$updateUser->id,
                                    'email'=>$updateUser->email,
                                    'username'=>$updateUser->username,
                                    'password'=>$data['password'],
                                    'subject_email'=>trans('general.subject_verification_email'),
                                    'activation_code'=>'');


            } else {
                //send email verification
                $data_email = array('id'=>$updateUser->id,
                                    'email'=>$updateUser->email,
                                    'username'=>$updateUser->username,
                                    'password'=>$data['password'],
                                    'subject_email'=>trans('general.subject_verification_email'),
                                    'activation_code'=>$activation->code);
            }

            $this->sendEmailVerifcation($data_email);

        }catch(\Exception $e){
            DB::rollback();

            $user = array();
            $status = array('code' => '400','status' => 'error','message' => $e->getMessage(),'data'=>$user);
            return $status;

        }
        DB::commit();//commit transactions
        \Log::info('model insert user');
        $status = array('code' => '200','status' => 'success','data'=>$updateUser);
        return $status;
    }

    public function sendEmailVerifcation($data)
    {
        $mail = Mail::queue('email.verification', $data,
            function($message) use($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
                $message->to($data['email'], $data['email'])->subject($data['subject_email']);
            });

    }

    public function resetPassword($credentials)
    {
        try
        {
            $findUser = Sentinel::findByCredentials($credentials);
            if(!empty($findUser)) {

                ($reminder = Reminder::exists($findUser)) || ($reminder = Reminder::create($findUser));
                $data_email = array('id'=>$findUser->id,
                                    'email'=>$findUser->email,
                                    'username'=>$findUser->username,
                                    'subject_email'=>trans('general.subject_reset_password'),
                                    'activation_code'=>$reminder->code);
                $this->sendEmailResetPassword($data_email);

                $status = array('code'=>200,'status'=>'success','message'=>trans('general.reset_password_success'));
                return $status;

            } else {
                $status = array('code'=>400,'status'=>'error','message'=>trans('general.reset_password_error').'. '.trans('general.user_not_found'));
                return $status;
            }

        }catch(\Exception $e){

            $status = array('code'=>400,'status'=>'error','message'=>trans('general.reset_password_error').'. '.$e->getMessage());
            return $status;

        }

    }

    public function UpdatePasswordByID($id,$password)
    {
        try
        {

            $findUser = Sentinel::findById($id);
            ($reminder = Reminder::exists($findUser)) || ($reminder = Reminder::create($findUser));
            Reminder::complete($findUser, $reminder->code, $password);

            $data_email = array('id'=>$findUser->id,
                                'email'=>$findUser->email,
                                'username'=>$findUser->username,
                                'subject_email'=>trans('general.subject_change_password'),
                                'password' => $password,
                                'activation_code' => '',
                                'text_message'=>trans('general.text_update_password'));

                $data['user_id'] = $findUser->id;
                $data['description'] = 'Have change password';

                $this->sendEmailVerifcation($data_email);

            return $findUser;

        } catch (\Exception $e) {

            return false;

        }

    }

    public function verifyCodeResetPassword($user_id, $code)
    {
        $user = Sentinel::findById($user_id);
        if(!empty($user)) {

            if (Reminder::exists($user, $code)) {
                $user->code = $code;
                $status = array('code'=>200,'status'=>'success','message'=>trans('general.please_change_password'),'data'=>$user);
                return $status;

            } else {

                $status = array('code'=>400,'status'=>'error','message'=>trans('general.not_have_reset_password'),'data'=>array());
                return $status;

            }

        } else {

            $status = array('code'=>400,'status'=>'error','message'=>trans('general.user_not_found'),'data'=>array());
            return $status;

        }
    }

    public function sendEmailResetPassword($data)
    {
        $mail = Mail::queue('email.reset_password', $data,
            function($message) use($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
                $message->to($data['email'], $data['email'])->subject($data['subject_email']);
            });
    }


    public function setLoginUser($param){
        $credentials = [
            'email'    => $param['email'],
            'password' => $param['password'],
        ];

        try{

            $auth = Sentinel::authenticate($credentials);

            if(!empty($auth)){
                $status = array('code'=>'200','status'=>'success','data'=>$auth);
            } else {
                $status = array('code'=>'400','status'=>'error','message'=>trans('general.invalid_login'),'data'=>array());
            }
            return $status;

        }catch(\Exception $e){

            $status = array('code'=>'400','status'=>'error','message'=>$e->getMessage(),'data'=>array());
            return $status;

        }
    }

    public function checkUserByEmail($email)
    {
        $user = $this->where(['email'=>$email])->first();
        if (count($user) > 0) {
            return $user;
        } else {
            return false;
        }
    }

    public function changePassword($user_id,$code,$password)
    {
        $user = Sentinel::findById($user_id);
        if(!empty($user)) {

            try
            {
                Reminder::complete($user, $code, $password);
                $status = array('code'=>'200','status'=>'success','message'=>trans('general.change_password_success'),'data'=>$user);
                return $status;
            }catch(\Exception $e){
                $status = array('code'=>'400','status'=>'error','message'=>$e->getMessage(),'data'=>array());
                return $status;
            }
        } else {

            $status = array('code'=>'400','status'=>'error','message'=>trans('general.user_not_found'),'data'=>array());
            return $status;

        }

    }

    public function findUserByUsername($username)
    {
        $user = $this->where(['username'=>$username])->first();
        if(count($user) > 0) {

            $userData = $this->refactorAddressUser($user);

            return $userData;

        } else {
            return false;
        }
    }

    public function findUserByID($id)
    {
        $user = $this->find($id);
        if(count($user) > 0) {

            $userData = $this->refactorAddressUser($user);

            return $userData;

        } else {
            return false;
        }
    }



    public function updateDataUser($param,$id)
    {
        $user = $this->find($id);
        if(!empty($user)) {

            $user->email        = $param['email'];
            $user->first_name   = $param['first_name'];
            $user->last_name    = $param['last_name'];
            $user->phone        = $param['phone'];
            $user->username     = $param['username'];
            $user->address      = $param['address'];
            
            if(!empty($param['role'])){

                $roleUser = $user->RoleUsers;
                $old_role = $roleUser[0]->slug;
                $new_role = $param['role'];
                if($old_role != $new_role){
                    $updateRole = Sentinel::findRoleBySlug($new_role);
                    $updateRole->users()->attach($user);

                    $removeRole = Sentinel::findRoleBySlug($old_role);
                    $removeRole->users()->detach($user);
                }
            }

            $user->save();

            $userData = $this->refactorAddressUser($user);

            return $userData;

        } else {
            return false;
        }
    }

    public function bannedByid($id)
    {
        $user = $this->find($id);
        if (!empty($user)) {
            $user->deleted = true;
            $user->save();
            return $user;
        } else {
            return false;
        }
    }

    public function restoreUserbyId($id)
    {
        $user = $this->find($id);
        if (!empty($user)) {
            $user->deleted = false;
            $user->save();
            return $user;
        } else {
            return false;
        }
    }

    public function UpdateProfileUser($param, $id)
    {

        $user = $this->find($id);
        if(!empty($user)) {

            $user->username     = $param['username'];

            $user->save();

            $userData = $this->refactorAddressUser($user);

            return $userData;

        } else {
            return false;
        }

    }
    
    public static function getUser($id="",$field="",$type="")
    {   
        if($id != ''){
            $eloq_user = Sentinel::findRoleBySlug('member')->users()->where('id',$id);
            if($eloq_user->count() == 1){     
                $user_id = $eloq_user->get()->first()->id;
                if($field == 'name'){                                        
                        return $eloq_user->get()->first()->first_name.' '.$eloq_user->get()->first()->last_name;
                }else if($field == 'avatar_path'){                                        
                    if($eloq_user->get()->first()->avatar == null or $eloq_user->get()->first()->avatar == ""){
                        return asset('assets/general/images/default/avatar.png');
                    }else{
                        return asset('storage/avatars').'/'.$eloq_user->get()->first()->avatar;
                    }
                }else{
                    return $eloq_user->get()->first()->{$field};                    
                }
            }else{
                // format Error
                return '';
            }
        }else{
                return '';
        }
    }
    public static function getIdUser($field="",$value="")
    {   
        $eloq_user = Sentinel::findRoleBySlug('member')->users()->where($field,'like', '%' . $value . '%');
        if($eloq_user->count() > 0){
            return $eloq_user->get()->first()->id;                    
        }else{
            return '';
        }
    }
}
