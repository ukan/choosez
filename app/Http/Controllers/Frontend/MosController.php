<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Mos;
use App\Models\RoomList;
use App\Models\AutoresponseEmail;
use App\Models\Activation;

use Illuminate\Http\Request;

use Validator;
use View;
use Input;
use Mail;

class MosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('frontend.mos.index');
    }

    public function post_register_mos(Request $request)
    {   
        $response = array();
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
            'email'   => 'required|email|unique:mos',
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
            'email.unique' => 'Alamat email sudah ada',
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
            if(!empty($request->mos_id)){
                $mos = Mos::find($request->mos_id);
            }else{
                $mos = new Mos;
            }
                $asrama = RoomList::where('id', $request->asrama)->first()->name;
                $kamar = RoomList::where('id', $request->kamar)->first()->name;
                
                $mos->name = $request->name;
                $mos->place_of_birth = $request->place;
                $mos->date_of_birth = $request->date;
                $mos->gender = $request->gender;
                $mos->address = $request->address;
                $mos->dorm = $asrama;
                $mos->room = $kamar;
                $mos->major = $request->major;
                $mos->phone = $request->phone;
                $mos->email = strtolower($request->email);
                if($param['event'][0] == "Ta'aruf"){
                    $mos->taaruf = "Ya";
                    if(isset($param['event'][1])){
                        $mos->lpks = "Ya";
                    }
                }else{
                    $mos->taaruf    = "Tidak";
                    $mos->lpks      = "Ya";
                }
                
                $mos->tsirt_size = $request->tshirtSize;

                if($request->hasFile('imageConfirm')) {
                    createdirYmd('storage/mos');
                    $file = Input::file('imageConfirm');
                    $name = str_random(20). '-' .$file->getClientOriginalName();
                    $mos->image_confirm = date("Y")."/".date("m")."/".date("d")."/".$name;
                    $file->move(public_path().'/storage/mos/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                }

                $password = "";
                for ($i = 0; $i<8; $i++) 
                {
                    $password .= mt_rand(0,9);
                }

                $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
                $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$password, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
                $sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);

                $mos->password = $sentEncrypt;

                $mos->save();

                $active = new Activation;
                $active->user_id = $mos->id;
                $active->code = bin2hex(random_bytes(16));
                $active->completed = true;
                $active->completed_at = date('Y-m-d H:i:s');
                $active->save();

                // AutoresponseEmail::create([
                //     'email' => strtolower($request->email),
                //     'full_name' => $request->name,
                //     'password' => $password,
                //     'type' => AutoresponseEmail::MOS_REGISTER,
                //     'status' => AutoresponseEmail::STATUS,
                // ]);
            
                $find_data['email'] = strtolower($request->email);
                $find_data['full_name'] = $request->name;
                $find_data['password'] = $password;
                
                Mail::send('email.new_mos_register', $find_data, function($message) use($find_data) {
                            $message->from("noreply@ponpesalihsancbr.id", 'Al-Ihsan No-Reply');
                            $message->to($find_data['email'], $find_data['full_name'])->subject('Notification');
                        });

                $response['notification'] = "Register Successfully";
                $response['status'] = "success";
        }

        echo json_encode($response);
    }
}