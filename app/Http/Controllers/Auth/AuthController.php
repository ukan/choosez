<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Models\AuthLog;
use Sentinel;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function signup(Request $req)
    {
        return view('auth.partials.signup');
    }

    public function getLogin()
    {
        $form = [
            'url' => route('admin-login'),
            'autocomplete' => 'off',
        ];

        return view('auth.partials.signin', compact('form'))->with('type','admin');
    }

    public function postLogin(Request $request)
    {
        if($request->input('type') == "member"){
            $route_login_type = "member-login";
            $route_dashboard_type = "member-dashboard";
        }else{
            $route_login_type = "admin-login";
            $route_dashboard_type = "admin-dashboard";
        }
        $backToLogin = redirect()->route($route_login_type)->withInput();
        $findUser = Sentinel::findByCredentials(['login' => $request->input('email')]);

        // If we can not find user based on email...
        if (! $findUser) {
            flash()->error('Wrong email!');

            return $backToLogin;
        }

        try {
            $remember = (bool) $request->input('remember_me');
            $user = User::where('email',$request->input('email'));
            if($user->count() > 0){
                $user = User::find($user->first()->id);
            }
            
            // If password is incorrect...
            if (! Sentinel::authenticate($request->all(), $remember)) {
                flash()->error('Password is incorrect!');
                return $backToLogin;
            }

            if (strtolower(Sentinel::check()->roles[0]->slug) != 'member' and $request->input('type') == "member" or strtolower(Sentinel::check()->roles[0]->slug) == 'member' and $request->input('type') == "admin") {
                flash()->error('You Have No Access!');
                Sentinel::logout();
                return $backToLogin;
            }

            if ($request->input('remember_me') == TRUE) {
                Session::put('field_email',$request->input('email'));
                Session::put('field_password',$request->input('password'));
            }

            if (!empty($_SERVER['HTTP_CLIENT_IP'])){
              $ip=$_SERVER['HTTP_CLIENT_IP'];
            }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
              $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }else{
              $ip=$_SERVER['REMOTE_ADDR'];
            }
            $ipAddress = $ip;
            
            $getEmail = User::where('email','=', $request->email)->get();
            foreach ($getEmail as $value) {
                $idUser = $value->id;   
            }

            $logs = new AuthLog;
            $logs->user_id = $idUser;
            $logs->ip_address = $ipAddress;
            $logs->login = date('Y-m-d H:i:s');
            $logs->save();

            flash()->success('Login success!');
            return redirect()->route($route_dashboard_type);
        } catch (ThrottlingException $e) {
            flash()->error('Too many attempts!');
        } catch (NotActivatedException $e) {
            flash()->error('Please activate your account before trying to log in.');
        }

        return $backToLogin;
    }

    public function getLogout()
    {
        $route = 'member-login';      
        
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
