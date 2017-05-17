<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BulletinBoard;
use App\Models\Subscribe;
use App\Models\ContactUs;
use App\Models\User;
use App\Models\LocationInformation;
use App\Models\RoomList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Validator;
use Cache;
use Mail;
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
                    ->orderBy('updated_at', 'desc')
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
            'url' => route('admin-login'),
            'autocomplete' => 'off',
        ];

        return view('auth.partials.signin', compact('form'))->with('type','member');
    }

    public function postLogin(Request $request)
    {
        if($request->input('type') == "member"){
            $route_login_type = "admin-login-member";
            $route_dashboard_type = "admin-dashboard-member";
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

    public function post_register_data(Request $request)
    {
        $response = array();
        $param = $request->all();

        $rules = array(
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
            'kecamatan'   => 'required|not_in:Pilih kecamatan',
            'desa'   => 'required',
            'sd'   => 'required',
            'smp'   => 'required',
            'sma'   => 'required',
            'ayah'   => 'required',
            'umur_ayah'   => 'required|numeric',
            'pendidikan_terakhir_ayah'   => 'required',
            'pekerjaan_ayah'   => 'required',
            'ibu'   => 'required',
            'umur_ibu'   => 'required|numeric',
            'pendidikan_terakhir_ibu'   => 'required',
            'pekerjaan_ibu'   => 'required',
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

                $sub_district = LocationInformation::where('province_id', $setCity[1])
                         ->where('district_id', $setCity[0])
                         ->where('sub_district_id', $request->kecamatan)
                         ->get()->first()->name;

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
                $data->email = $request->email;
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
                $data->mother_age = $request->umur_ibu;
                $data->m_last_study = $request->pendidikan_terakhir_ibu;
                $data->m_current_job = $request->pekerjaan_ibu;
                $data->gender = $request->jenis_kelamin;
                $data->hostel = ucwords(strtolower($asrama));
                $data->room = ucwords(strtolower($kamar));

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

                $data->password = Hash::make("room");
                $data->save();

                $response['notification'] = "Register Successfully";
                $response['status'] = "success";
        }

        echo json_encode($response);
    }
}
