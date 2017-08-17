<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Mos;
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
            'asrama'   => 'required',
            'kamar'   => 'required',
            'major'   => 'required',
            'phone'   => 'required|numeric',
            'email'   => 'required|email|unique:mos',
            'tshirtSize'   => 'required|not_in:Pilih Ukuran Kaos',
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
            'tshirtSize.required' => 'Ukuran kaos wajib diisi',
            'imageConfirm.required' => 'Bukti pembayaran wajib diisi',
            'imageConfirm.image' => 'Bukti pembayaran tidak valid',
            'gender.not_in' => 'Jenis kelamin tidak valid',
            'tshirtSize.not_in' => 'Ukuran kaos tidak valid',
        ];

        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules, $message);
        } else {
                $mos = new Mos;
                $mos->name = $request->name;
                $mos->place_of_birth = $request->place;
                $mos->date_of_birth = $request->date;
                $mos->gender = $request->gender;
                $mos->address = $request->address;
                $mos->dorm = $request->asrama;
                $mos->room = $request->kamar;
                $mos->major = $request->major;
                $mos->phone = $request->phone;
                $mos->email = $request->email;
                $mos->tsirt_size = $request->tshirtSize;

                if($request->hasFile('imageConfirm')) {
                    createdirYmd('storage/mos');
                    $file = Input::file('imageConfirm');
                    $name = str_random(20). '-' .$file->getClientOriginalName();
                    $mos->image_confirm = date("Y")."/".date("m")."/".date("d")."/".$name;
                    $file->move(public_path().'/storage/mos/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                }
                $mos->save();

                $find_data['email'] = $request->email;
                $find_data['full_name'] = $request->name;
                
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