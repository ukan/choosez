<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BulletinBoard;
use App\Models\Subscribe;
use App\Models\ContactUs;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\BimtesRegister;
use App\Models\Mos;
use App\Models\LocationInformation;
use App\Models\RoomList;
use App\Models\AuthLog;
use App\Models\AuthLogBimtes;
use App\Models\AuthLogMos;
use App\Models\AuditrailLog;
use App\Models\Activation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Redirect;
use Validator;
use Cache;
use Mail;
use Sentinel;
use Input;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function redis($language){
        Cache::forever('language', $language);

        return Redirect::back();
    }

    public function indexBimtes($id)
    {   
        $beforeDecrypt = str_replace('zpaIwL8TvQqP','/',$id);
        $cryptKey   = 'qJB0rGtIn5UB1xG03efyCp';
        $decrypted  = rtrim( mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),base64_decode($beforeDecrypt),
                MCRYPT_MODE_CBC,md5(md5($cryptKey))), "\0");
        if (!is_numeric($decrypted)) {
            $bimtes_data = null;
            return view('backend.unautor')->with('data', $bimtes_data);
        }
        $bimtes_data = BimtesRegister::find($decrypted);
        return view('frontend.member.dashboard.homepage')->with('data', $bimtes_data);
    }

    public function indexMos($id)
    {   
        $beforeDecrypt = str_replace('zpaIwL8TvQqP','/',$id);
        $cryptKey   = 'qJB0rGtIn5UB1xG03efyCp';
        $decrypted  = rtrim( mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),base64_decode($beforeDecrypt),
                MCRYPT_MODE_CBC,md5(md5($cryptKey))), "\0");
        if (!is_numeric($decrypted)) {
            $bimtes_data = null;
            return view('backend.unautor')->with('data', $bimtes_data);
        }
        $bimtes_data = Mos::find($decrypted);
        return view('frontend.member.dashboard.homemos')->with('data', $bimtes_data);
    }

    public function index()
    {
        $data = BulletinBoard::where('status','article')
                    ->where('publish_status', 'Yes')
                    ->orderBy('updated_at', 'desc')
                    ->take(6)->get();

        $getData = [];
        $x = 0;

        foreach ($data as $key => $value) {
            $getData[$x] = $value;

            $x++;
        }
        $count_article = count($getData);

        $data_editor = BulletinBoard::where('status','news')
                    ->where('publish_status', 'Yes')
                    ->orderBy('updated_at', 'desc')
                    ->take(6)->get();

        $getDataEditor = [];
        $x = 0;
        foreach ($data_editor as $key => $value) {
            $getDataEditor[$x] = $value;

            $x++;
        }
        $count_news = count($getDataEditor);

        $data_recent = BulletinBoard::where('publish_status', 'Yes')
                    ->orderBy('created_at', 'desc')
                    ->take(4)->get();
        $getDataRecent = [];
        $x = 0;
        foreach ($data_recent as $key => $value) {
            $getDataRecent[$x] = $value;

            $x++;
        }

        return view('frontend.dashboard.home')
                 ->with('count_article',$count_article)
                 ->with('count_news',$count_news)
                 ->with('bulletin_recent',$getDataRecent)
                 ->with('bulletin_article',$getData)
                 ->with('bulletin_news',$getDataEditor);
        // return view('email.new_post');
    }
    public function sign_in(){
        $form = [
            'url' => route('admin-login-member'),
            'autocomplete' => 'off',
        ];

        return view('frontend.login', compact('form'))->with('type','member');
    }

    public function sign_in_bimtes(){
        $form = [
            'url' => route('login-member-bimtes'),
            'autocomplete' => 'off',
        ];

        return view('frontend.login', compact('form'))->with('type','member');
    }

    public function sign_in_mos(){
        $form = [
            'url' => route('login-member-mos'),
            'autocomplete' => 'off',
        ];

        return view('frontend.login_mos', compact('form'))->with('type','member');
    }

    public function postLogin(Request $request)
    {
        
        $route_login_type = "admin-login-member";
        $route_dashboard_type = "member-profile";
        
        $backToLogin = redirect()->route($route_login_type)->withInput();
        $findUser = Sentinel::findByCredentials(['login' => strtolower($request->input('email'))]);

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

            $request_data = [];
            $request_data['email'] = strtolower($request->email);
            $request_data['password'] = $request->password;
            // If password is incorrect...
            if (! Sentinel::authenticate($request_data, $remember)) {
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

    public function postLoginBimtes(Request $request)
    {
        $route_login_type = "login-member-bimtes";
        $route_dashboard_type = "dashboard-member-bimtes";
        
        $backToLogin = redirect()->route($route_login_type)->withInput();
        $findUser = BimtesRegister::where('email',strtolower($request->input('email')))->get()->first();
        // If we can not find user based on email...
        if (! $findUser) {
            flash()->error('Wrong email!');

            return $backToLogin;
        }

        try {
            $remember = (bool) $request->input('remember_me');
            $user = BimtesRegister::where('email',$request->input('email'));
            if($user->count() > 0){
                $user = BimtesRegister::find($user->first()->id);
            }

            $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
                    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$request->input('password'), MCRYPT_MODE_CBC,md5(md5($cryptKey))));
                    $sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);

            // If password is incorrect...
            $getBim = BimtesRegister::where('password', $sentEncrypt)->get()->first();
            if (count($getBim) <= 0) {
                flash()->error('Password is incorrect!');
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

            $logs = new AuthLogBimtes;
            $logs->bimtes_register_id = $getBim->id;
            $logs->ip_address = $ipAddress;
            $logs->login = date('Y-m-d H:i:s');
            $logs->save();

            $cryptKeyc  = 'qJB0rGtIn5UB1xG03efyCp';
                    $encryptedc = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKeyc),$getBim->id, MCRYPT_MODE_CBC,md5(md5($cryptKeyc))));
                    $sentEncryptc = str_replace('/','zpaIwL8TvQqP', $encryptedc);

            flash()->success('Login success!');
            return redirect()->route($route_dashboard_type, $sentEncryptc);
        } catch (ThrottlingException $e) {
            flash()->error('Too many attempts!');
        } catch (NotActivatedException $e) {
            flash()->error('Please activate your account before trying to log in.');
        }

        return $backToLogin;
    }

    public function postLoginMos(Request $request)
    {
        $route_login_type = "login-member-mos";
        $route_dashboard_type = "dashboard-member-mos";
        
        $backToLogin = redirect()->route($route_login_type)->withInput();
        $findUser = Mos::where('email',strtolower($request->input('email')))->get()->first();
        // If we can not find user based on email...
        if (! $findUser) {
            flash()->error('Wrong email!');

            return $backToLogin;
        }

        try {
            $remember = (bool) $request->input('remember_me');
            $user = Mos::where('email',$request->input('email'));
            if($user->count() > 0){
                $user = Mos::find($user->first()->id);
            }

            $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
                    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$request->input('password'), MCRYPT_MODE_CBC,md5(md5($cryptKey))));
                    $sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);

            // If password is incorrect...
            $getBim = Mos::where('password', $sentEncrypt)->get()->first();
            if (count($getBim) <= 0) {
                flash()->error('Password is incorrect!');
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

            $logs = new AuthLogMos;
            $logs->mos_register_id = $getBim->id;
            $logs->ip_address = $ipAddress;
            $logs->login = date('Y-m-d H:i:s');
            $logs->save();

            $cryptKeyc  = 'qJB0rGtIn5UB1xG03efyCp';
                    $encryptedc = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKeyc),$getBim->id, MCRYPT_MODE_CBC,md5(md5($cryptKeyc))));
                    $sentEncryptc = str_replace('/','zpaIwL8TvQqP', $encryptedc);

            flash()->success('Login success!');
            return redirect()->route($route_dashboard_type, $sentEncryptc);
        } catch (ThrottlingException $e) {
            flash()->error('Too many attempts!');
        } catch (NotActivatedException $e) {
            flash()->error('Please activate your account before trying to log in.');
        }

        return $backToLogin;
    }

    public function getLogout()
    {
        $route = 'login-member-bimtes';
        
        return redirect()->route($route);
    }

    public function getLogoutMos()
    {
        $route = 'login-member-mos';
        
        return redirect()->route($route);
    }

    public function sign_up(){

    }
    public function contact(){

        return view('frontend.contact.contact_us');
    }

    public function newsDetail($slug)
    {
        /*$beforeDecrypt = str_replace('zpaIwL8TvQqP','/',$id);
        $cryptKey   = 'qJB0rGtIn5UB1xG03efyCp';
        $decrypted  = rtrim( mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),base64_decode($beforeDecrypt),
                MCRYPT_MODE_CBC,md5(md5($cryptKey))), "\0");*/

        $bulletin = BulletinBoard::where('slug',$slug)->orderBy('id')->get()->first();
        $bulletin->counter = $bulletin->counter+1;
        $bulletin->save();

        $data = BulletinBoard::where('slug',$slug)->orderBy('id')->get();

        $getData = [];
        $x = 0;
        foreach ($data as $key => $value) {
            $getData[$x] = $value;

            $x++;
        }
        return view('frontend.news.index')->with('news', $getData);
    }

    public function subscribe(Request $request)
    {
        $response = array();
        $param = $request->all();

        $rules = array(
            'email'   => 'required|email|unique:subscribes',
        );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules);
        } else {

                $data = new Subscribe;

                $data->email = $request->email;
                $data->status = "waiting";
                $data->save();

                $find_data['email'] = $request->email;
                $find_data['id'] = $data->id;
                $find_data['full_name'] = "User";
                Mail::send('email.subscribe_confirmation', $find_data, function($message) use($find_data) {
                            $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                            $message->to($find_data['email'], $find_data['full_name'])->subject('Subscribe Confirmation');
                        });

                $response['notification'] = "Subscribe Success";
                $response['status'] = "success";
        }

        echo json_encode($response);
    }

    public function subscribe_confirmation(Request $request)
    {
        $data = Subscribe::find($request->id);

        $data->status = "confirmed";
        $data->save();

        flash()->overlay('You have successfully subscribed to the newsletter', 'Notice');

        return redirect()->to('/');
    }

    public function post_contact(Request $request)
    {
        $response = array();
        $param = $request->all();

        $rules = array(
            'name'   => 'required',
            'email'   => 'required|email|unique:contact_us',
            'subject'   => 'required',
            'message'   => 'required',
        );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules);
        } else {

                $data = new ContactUs;

                $data->name = $request->name;
                $data->email = $request->email;
                $data->subject = $request->subject;
                $data->message = $request->message;
                $data->save();

                $response['notification'] = "Send Message Successfully";
                $response['status'] = "success";
        }

        echo json_encode($response);
    }

    public function register(){
        return view('frontend.register.index');
    }

    public function registerAlumni(){
        return view('frontend.register-alumni.index');
    }

    public function post_register_data(Request $request)
    {
        $response = array();
        $param = $request->all();

        $rules = array(
            'image'   => 'required|image',
            'nama'   => 'required',
            'nama_panggilan'   => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'   => 'required',
            'rt'   => 'required|numeric',
            'rw'   => 'required|numeric',
            'kode_pos'   => 'required|numeric',
            'alamat'   => 'required',
            'provinsi'   => 'required|not_in:Pilih Provinsi',
            'kota'   => 'required|not_in:Pilih Kabupaten/Kota',
            // 'kecamatan'   => 'required|not_in:Pilih kecamatan',
            'desa'   => 'required',
            'sd'   => 'required',
            'smp'   => 'required',
            'sma'   => 'required',
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
            'email'   => 'required|email|unique:users',
            'jenis_kelamin'   => 'required|not_in:Pilih Jenis Kelamin',
            'asrama'   => 'required|not_in:Pilih Asrama',
            'kamar'   => 'required',
        );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules);
        } else {

                $setCity = explode('/', $request->kota);
                
                $province = LocationInformation::where('province_id', $request->provinsi)->get()->first()->name;
                $kota = LocationInformation::where('province_id', $setCity[1])
                         ->where('district_id', $setCity[0])
                         ->get()->first()->name;
                if(!empty($request->kecamatan)){
                    $sub_district = LocationInformation::where('province_id', $setCity[1])
                         ->where('district_id', $setCity[0])
                         ->where('sub_district_id', $request->kecamatan)
                         ->get()->first()->name;
                }else{
                    $sub_district = "";
                }

                $asrama = RoomList::where('id', $request->asrama)->get()->first()->name;
                $kamar = RoomList::where('id', $request->kamar)->get()->first()->name;

                $data = new User;

                $data->username = $request->nama;
                $data->first_name = $request->nama_panggilan;
                $data->place_of_birth = $request->tempat_lahir;
                $data->date_of_birth = $request->tanggal_lahir;
                $data->address = $request->alamat;
                $data->rt = $request->rt;
                $data->rw = $request->rw;
                $data->village = $request->desa;
                $data->sub_district = ucwords(strtolower($sub_district));
                $data->city_or_district = ucwords(strtolower($kota));
                $data->province = ucwords(strtolower($province));
                $data->postal_code = $request->kode_pos;
                $data->phone = $request->telepon;
                $data->email = strtolower($request->email);
                $data->sd = $request->sd;
                $data->sd_th = $request->tahun_lulus_sd;
                $data->sltp = $request->smp;
                $data->sltp_th = $request->tahun_lulus_smp;
                $data->slta = $request->sma;
                $data->slta_th = $request->tahun_lulus_sma;
                $data->mbs = $request->ponpes;
                $data->university = $request->univ;
                $data->faculty = $request->fakultas;
                $data->major = $request->jurusan;
                $data->semester = $request->semester;
                $data->father_name = $request->ayah;
                $data->fahter_age = $request->umur_ayah;
                $data->f_last_study = $request->pendidikan_terakhir_ayah;
                $data->f_current_job = $request->pekerjaan_ayah;
                $data->mother_name = $request->ibu;
                $data->jenjang = $request->jenjang_pendidikan;
                $data->mother_age = $request->umur_ibu;
                $data->m_last_study = $request->pendidikan_terakhir_ibu;
                $data->m_current_job = $request->pekerjaan_ibu;
                $data->gender = $request->jenis_kelamin;
                $data->hostel = ucwords(strtolower($asrama));
                $data->room = ucwords(strtolower($kamar));
                $data->status = "Santri";

                if($request->hasFile('image')) {
                    if($request->action == 'update'){
                        if($data->image != ""){
                        $image_path = public_path().'/storage/student/'.$data->image;
                        unlink($image_path);
                        }
                    }
                    createdirYmd('storage/student');
                    $file = Input::file('image');
                    $name = str_random(20). '-' .$file->getClientOriginalName();
                    $data->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                    $file->move(public_path().'/storage/student/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                }

                $password = "";
                for ($i = 0; $i<8; $i++) 
                {
                    $password .= mt_rand(0,9);
                }

                $data->password = Hash::make($password);
                $data->save();

                $active = new Activation;
                $active->user_id = $data->id;
                $active->code = bin2hex(random_bytes(16));
                $active->completed = true;
                $active->completed_at = date('Y-m-d H:i:s');
                $active->save();

                Sentinel::findRoleBySlug('member')->users()->attach(Sentinel::findById($data->id));

                $find_data['password'] = $password;
                $find_data['email'] = strtolower($request->email);
                $find_data['first_name'] = $request->nama_panggilan;
                $find_data['image'] = $data->image;
                
                Mail::send('email.new_user', $find_data, function($message) use($find_data) {
                            $message->from("noreply@ponpesalihsancbr.id", 'Al-Ihsan No-Reply');
                            $message->to($find_data['email'], $find_data['first_name'])->subject('New Account');
                        });

                $response['notification'] = "Register Successfully";
                $response['status'] = "success";
        }

        echo json_encode($response);
    }

    public function post_register_bimtes(Request $request){
        $response = array();
        $param = $request->all();

        $rules = array(
            // 'image'   => 'required|image',
            'nama'   => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'   => 'required',
            'alamat'   => 'required',
            'sekolah_asal'   => 'required',
            'tahun_lulus'   => 'required|numeric',
            'jenis_kelamin'   => 'required|not_in:Pilih Jenis Kelamin',
            'no_kontak'   => 'required|numeric',
            'email'   => 'required|email|unique:bimtes_register',
            // 'no_tes'   => 'required',
            // 'tanggal_tes'   => 'required',
            'pilihan_jurusan'   => 'required',
            'bukti_pembayaran'   => 'required|image',
        );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules);
        } else {
            if(!empty($request->bimtes_id)){
                $data = BimtesRegister::find($request->bimtes_id);
            }else{
                $data = new BimtesRegister;
            }
                $data->name = $request->nama;
                $data->place_of_birth = $request->tempat_lahir;
                $data->date_of_birth = $request->tanggal_lahir;
                $data->address = $request->alamat;
                $data->email = strtolower($request->email);
                $data->phone = $request->no_kontak;
                $data->slta = $request->sekolah_asal;
                $data->slta_th = $request->tahun_lulus;
                $data->gender = $request->jenis_kelamin;
                $data->test_number = $request->no_tes;
                $data->test_day = $request->tanggal_tes;
                $data->major1 = $request->pilihan_jurusan;
                $data->major2 = $request->pilihan_jurusan2;
                $data->major3 = $request->pilihan_jurusan3;

                if($request->hasFile('image')) {
                    if($request->action == 'update'){
                        if($data->photo != ""){
                        $image_path = public_path().'/storage/bimtes/photo/'.$data->photo;
                        unlink($image_path);
                        }
                    }
                    createdirYmd('storage/bimtes/photo');
                    $file = Input::file('image');
                    $name = str_random(20). '-' .$file->getClientOriginalName();
                    $data->photo = date("Y")."/".date("m")."/".date("d")."/".$name;
                    $file->move(public_path().'/storage/bimtes/photo/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                }
                if($request->hasFile('bukti_pembayaran')) {
                    if($request->action == 'update'){
                        if($data->image_confirm != ""){
                        $image_path = public_path().'/storage/bimtes/bukti/'.$data->image_confirm;
                        unlink($image_path);
                        }
                    }
                    createdirYmd('storage/bimtes/bukti');
                    $file = Input::file('bukti_pembayaran');
                    $name = str_random(20). '-' .$file->getClientOriginalName();
                    $data->image_confirm = date("Y")."/".date("m")."/".date("d")."/".$name;
                    $file->move(public_path().'/storage/bimtes/bukti/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                }

                $password = "";
                for ($i = 0; $i<8; $i++) 
                {
                    $password .= mt_rand(0,9);
                }

                $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
                    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$password, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
                    $sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);

                $data->password = $sentEncrypt;
                $data->save();

                $active = new Activation;
                $active->user_id = $data->id;
                $active->code = bin2hex(random_bytes(16));
                $active->completed = true;
                $active->completed_at = date('Y-m-d H:i:s');
                $active->save();

                $find_data_bimtes['password'] = $password;
                $find_data_bimtes['email'] = $request->email;
                $find_data_bimtes['full_name'] = $request->nama;
                
                Mail::send('email.new_bimtes', $find_data_bimtes, function($message) use($find_data_bimtes) {
                            $message->from("noreply@ponpesalihsancbr.id", 'Al-Ihsan No-Reply');
                            $message->to($find_data_bimtes['email'], $find_data_bimtes['full_name'])->subject('New Account');
                        });

                $user = User::select('email','first_name')
                            ->where('roles.slug', 'admin-bimtes')
                            ->join('role_users','role_users.user_id','=','users.id')
                            ->join('roles','roles.id','=','role_users.role_id')
                            ->get();

                foreach ($user as $key => $value) {
                    $find_data['email'] = $value->email;
                    $find_data['first_name'] = $value->first_name;
                    Mail::send('email.bimtes_notification', $find_data, function($message) use($find_data) {
                                $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                                $message->to($find_data['email'], $find_data['first_name'])->subject('Pendaftar Bimtes Baru');
                            });
                }

                $response['notification'] = "Register Successfully";
                $response['status'] = "success";
        }

        echo json_encode($response);
    }

    public function post_register_bimtes_edit(Request $request){
        $data = BimtesRegister::find($request->id);
        if(!empty($request->nama)){
            $data->name = $request->nama;
        }
        if(!empty($request->tempat_lahir)){
            $data->place_of_birth = $request->tempat_lahir;
        }
        if(!empty($request->tanggal_lahir)){
            $data->date_of_birth = $request->tanggal_lahir;
        }
        if(!empty($request->alamat)){
            $data->address = $request->alamat;
        }
        if(!empty($data->email) && ($request->email!=$data->email) ){
            $data->email = $request->email;
        }
        if(!empty($request->no_kontak)){
            $data->phone = $request->no_kontak;
        }
        if(!empty($request->sekolah_asal)){
            $data->slta = $request->sekolah_asal;
        }

        if(!empty($request->tahun_lulus)){
            $data->slta_th = $request->tahun_lulus;
        }
        if(!empty($request->jenis_kelamin)){
            $data->gender = $request->jenis_kelamin;
        }
        if(!empty($request->no_tes)){
            $data->test_number = $request->no_tes;
        }
        if(!empty($request->tanggal_tes)){
            $data->test_day = $request->tanggal_tes;
        }
        if(!empty($request->pilihan_jurusan)){
            $data->major1 = $request->pilihan_jurusan;
        }
        if(!empty($request->pilihan_jurusan2)){
            $data->major2 = $request->pilihan_jurusan2;
        }
        if(!empty($request->pilihan_jurusan3)){
            $data->major3 = $request->pilihan_jurusan3;
        }

        if($request->hasFile('image')) {
            if($request->action == 'update'){
                if($data->photo != ""){
                    $image_path = public_path().'/storage/bimtes/photo/'.$data->photo;
                    unlink($image_path);
                }
            }
            createdirYmd('storage/bimtes/photo');
            $file = Input::file('image');
            $name = str_random(20). '-' .$file->getClientOriginalName();
            $data->photo = date("Y")."/".date("m")."/".date("d")."/".$name;
            $file->move(public_path().'/storage/bimtes/photo/'.date("Y")."/".date("m")."/".date("d")."/", $name);
        }
        if($request->hasFile('bukti_pembayaran')) {
            if($request->action == 'update'){
                if($data->image_confirm != ""){
                $image_path = public_path().'/storage/bimtes/bukti/'.$data->image_confirm;
                unlink($image_path);
                }
            }
            createdirYmd('storage/bimtes/bukti');
            $file = Input::file('bukti_pembayaran');
            $name = str_random(20). '-' .$file->getClientOriginalName();
            $data->image_confirm = date("Y")."/".date("m")."/".date("d")."/".$name;
            $file->move(public_path().'/storage/bimtes/bukti/'.date("Y")."/".date("m")."/".date("d")."/", $name);
        }

        $data->save();

        return redirect()->back();
    }

    public function post_register_mos_edit(Request $request){
        
        $audit = new AuditrailLog;

        $param = $request->all();
        $rules = array( 
            'name'   => 'required',
            'place'   => 'required',
            'date'   => 'required',
            'gender'   => 'required|not_in:Pilih Jenis Kelamin',
            'address'   => 'required',
            'asrama'   => 'required|not_in:Pilih Asrama',
            'kamar'   => 'required|not_in:Pilih Kamar',
            'major'   => 'required',
            'phone'   => 'required|numeric',
            'email'   => 'required|email',
            'tshirtSize'   => 'required|not_in:Pilih Ukuran Kaos',
            'event'   => 'required',
            'imageConfirm'   => 'required|image',
        );

        $message = [
            'name.required' => 'Nama wajib diisi',
            'place.required' => 'Tempat lahir wajib diisi',
            'date.required' => 'Tanggal lahir wajib diisi',
            'gender.required' => 'Jenis kelamin wajib diisi',
            'address.required' => 'Alamat wajib diisi',
            'asrama.required' => 'Asrama wajib diisi',
            'kamar.required' => 'Kamar wajib diisi',
            'major.required' => 'Jurusan wajib diisi',
            'phone.required' => 'No. Kontak wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Alamat email tidak valid',
            'tshirtSize.required' => 'Ukuran kaos wajib diisi',
            'tshirtSize.not_in' => 'Ukuran kaos tidak valid',
            'imageConfirm.required' => 'Bukti pembayaran wajib diisi',
            'imageConfirm.image' => 'Bukti pembayaran tidak valid',
            'gender.not_in' => 'Jenis kelamin tidak valid',
            'event.required' => 'Jenis kegiatan wajib dipilih',
            'asrama.not_in' => 'Asrama tidak valid',
            'kamar.not_in' => 'Kamar tidak valid',
        ];
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules, $message);
        } else {

            $data = Mos::find($request->id);
            
            if($param['event'][0] == "Ta'aruf"){
                $dataTaaruf = "Ya";
                if(isset($param['event'][1])){
                    $dataLpks = "Ya";
                }else{
                    $dataLpks = "Tidak";
                }
            }else{
                $dataTaaruf = "Tidak";
                $dataLpks = "Ya";
            }

            $audit->email = $data->email;
            $audit->table_name = "Mos";
            $audit->action = "Edit";
            $audit->before = 
                $data->name.' | '.
                $data->place_of_birth.' | '.
                $data->date_of_birth.' | '.
                $data->address.' | '.
                $data->email.' | '.
                $data->phone.' | '.
                $data->gender.' | '.
                $data->dorm.' | '.
                $data->room.' | '.
                $data->major.' | '.
                $data->tsirt_size.' | '.
                $data->taaruf.' | '.
                $data->lpks.' | '.
                $data->image_confirm;

            $audit->after = 
                $request->name.' | '.
                $request->place.' | '.
                $request->date.' | '.
                $request->address.' | '.
                $request->email.' | '.
                $request->phone.' | '.
                $request->gender.' | '.
                $request->asrama.' | '.
                $request->kamar.' | '.
                $request->major.' | '.
                $request->tshirtSize.' | '.
                $dataTaaruf.' | '.
                $dataLpks.' | '.
                $request->imageConfirm;


            if(!empty($request->name)){
                $data->name = $request->name;
            }
            if(!empty($request->place)){
                $data->place_of_birth = $request->place;
            }
            if(!empty($request->date)){
                $data->date_of_birth = $request->date;
            }
            if(!empty($request->address)){
                $data->address = $request->address;
            }
            if(!empty($data->email) && ($request->email!=$data->email) ){
                $data->email = strtolower($request->email);
            }
            if(!empty($request->phone)){
                $data->phone = $request->phone;
            }
            if(!empty($request->gender)){
                $data->gender = $request->gender;
            }

            if(!empty($request->asrama) && $request->assrama != "Pilih Asrama"){
                $asrama = RoomList::where('id', $request->asrama)->first()->name;
                $data->dorm = $asrama;
            }
            if(!empty($request->kamar) && $request->kamar != "Pilih Kamar"){
                $kamar = RoomList::where('id', $request->kamar)->first()->name;
                $data->room = $kamar;
            }
            if(!empty($request->major)){
                $data->major = $request->major;
            }
            if(!empty($request->tshirtSize)){
                $data->tsirt_size = $request->tshirtSize;
            }
            
            if($param['event'][0] == "Ta'aruf"){
                $data->taaruf = "Ya";
                $dataTaaruf = "Ya";
                if(isset($param['event'][1])){
                    $data->lpks = "Ya";
                    $dataLpks = "Ya";
                }
            }else{
                $data->taaruf    = "Tidak";
                $data->lpks      = "Ya";
                $dataTaaruf = "Tidak";
                $dataLpks = "Ya";
            }

            if($request->hasFile('imageConfirm')) {
                if($request->action == 'update'){
                    if($data->image_confirm != ""){
                    $image_path = public_path().'/storage/mos/'.$data->image_confirm;
                    unlink($image_path);
                    }
                }
                createdirYmd('storage/mos');
                $file = Input::file('imageConfirm');
                $name = str_random(20). '-' .$file->getClientOriginalName();
                $data->image_confirm = date("Y")."/".date("m")."/".date("d")."/".$name;
                $file->move(public_path().'/storage/mos/'.date("Y")."/".date("m")."/".date("d")."/", $name);
            }

            $data->save();
            $audit->save();
        }

        return redirect()->back();
    }
}
