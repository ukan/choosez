<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RegisterStudent;
use App\Models\LocationInformation;
use Illuminate\Http\Request;
use Validator;
use View;

class PsbController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        return view('frontend.psb.index');
    }

    public function psbInfo()
    {   
        return view('frontend.psb.psb-info');
    }

    public function psbPrint()
    {   
        return view('frontend.psb.psb-print');
    }

    public function store(Request $request)
    {   
        // $response = array();
        $param = $request->all();

        $rules = array( 
            'nama'   => 'required',
            'nama_panggilan'   => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'   => 'required',
            'alamat'   => 'required',
            'provinsi'   => 'required|not_in:Pilih Provinsi',
            'kota'   => 'required|not_in:Pilih Kabupaten/Kota',
            'kecamatan'   => 'required|not_in:Pilih kecamatan',
            'desa'   => 'required',
            'rt'   => 'required',
            'rw'   => 'required',
            'kode_pos'   => 'required|numeric',
            'telepon'   => 'required|numeric',
            'email'   => 'required|email|unique:register_student',
            'sd'   => 'required',
            'tahun_lulus_sd'   => 'required|numeric',
            'smp'   => 'required',
            'tahun_lulus_smp'   => 'required|numeric',
            'sma'   => 'required',
            'tahun_lulus_sma'   => 'required|numeric',
            'ayah'   => 'required',
            'umur_ayah'   => 'required|numeric',
            'pendidikan_terakhir_ayah'   => 'required',
            'pekerjaan_ayah'   => 'required',
            'ibu'   => 'required',
            'umur_ibu'   => 'required|numeric',
            'pendidikan_terakhir_ibu'   => 'required',
            'pekerjaan_ibu'   => 'required',
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
                $registerStudent = new RegisterStudent;

                $registerStudent->name = $request->nama;
                $registerStudent->nick_name = $request->nama_panggilan;
                $registerStudent->place_of_birth = $request->tempat_lahir;
                $registerStudent->date_of_birth = $request->tanggal_lahir;
                $registerStudent->address = $request->alamat;
                $registerStudent->rt = $request->rt;
                $registerStudent->rw = $request->rw;
                $registerStudent->village = $request->desa;
                $registerStudent->sub_district = ucwords(strtolower($sub_district));
                $registerStudent->city = ucwords(strtolower($kota));
                $registerStudent->province = ucwords(strtolower($province));
                $registerStudent->postal_code = $request->kode_pos;
                $registerStudent->phone = $request->telepon;
                $registerStudent->email = $request->email;
                $registerStudent->sd = $request->sd;
                $registerStudent->sd_th = $request->tahun_lulus_sd;
                $registerStudent->sltp = $request->smp;
                $registerStudent->sltp_th = $request->tahun_lulus_smp;
                $registerStudent->slta = $request->sma;
                $registerStudent->slta_th = $request->tahun_lulus_sma;
                $registerStudent->mbs = $request->ponpes;
                $registerStudent->university = $request->univ;
                $registerStudent->faculty = $request->fakultas;
                $registerStudent->major = $request->jurusan;
                $registerStudent->semester = $request->semester;
                $registerStudent->father_name = $request->ayah;
                $registerStudent->fahter_age = $request->umur_ayah;
                $registerStudent->f_last_study = $request->pendidikan_terakhir_ayah;
                $registerStudent->f_current_job = $request->pekerjaan_ayah;
                $registerStudent->mother_name = $request->ibu;
                $registerStudent->mother_age = $request->umur_ibu;
                $registerStudent->m_last_study = $request->pendidikan_terakhir_ibu;
                $registerStudent->m_current_job = $request->pekerjaan_ibu;
                $registerStudent->save();

                $data = [
                    'nama' => $request->nama,
                    'nama_panggilan' => $request->nama_panggilan,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'desa' => $request->desa,
                    'kecamatan' => ucwords(strtolower($sub_district)),
                    'kota' => ucwords(strtolower($kota)),
                    'provinsi' => ucwords(strtolower($province)),
                    'kode_pos' => $request->kode_pos,
                    'telepon' => $request->telepon,
                    'email' => $request->email,
                    'sd' => $request->sd,
                    'tahun_lulus_sd' => $request->tahun_lulus_sd,
                    'smp' => $request->smp,
                    'tahun_lulus_smp' => $request->tahun_lulus_smp,
                    'sma' => $request->sma,
                    'tahun_lulus_sma' => $request->tahun_lulus_sma,
                    'ponpes' => $request->ponpes,
                    'univ' => $request->univ,
                    'fakultas' => $request->fakultas,
                    'jurusan' => $request->jurusan,
                    'semester' => $request->semester,
                    'ayah' => $request->ayah,
                    'umur_ayah' => $request->umur_ayah,
                    'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'ibu' => $request->ibu,
                    'umur_ibu' => $request->umur_ibu,
                    'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                ];

                $response['nama'] = $request->nama;
                $response['nama_panggilan'] = $request->nama_panggilan;
                $response['tempat_lahir'] = $request->tempat_lahir;
                $response['tanggal_lahir'] = $request->tanggal_lahir;
                $response['alamat'] = $request->alamat;
                $response['rt'] = $request->rt;
                $response['rw'] = $request->rw;
                $response['desa'] = $request->desa;
                $response['kecamatan'] = ucwords(strtolower($sub_district));
                $response['kota'] = ucwords(strtolower($kota));
                $response['provinsi'] = ucwords(strtolower($province));
                $response['kode_pos'] = $request->kode_pos;
                $response['telepon'] = $request->telepon;
                $response['email'] = $request->email;
                $response['sd'] = $request->sd;
                $response['tahun_lulus_sd'] = $request->tahun_lulus_sd;
                $response['smp'] = $request->smp;
                $response['tahun_lulus_smp'] = $request->tahun_lulus_smp;
                $response['sma'] = $request->sma;
                $response['tahun_lulus_sma'] = $request->tahun_lulus_sma;
                $response['ponpes'] = $request->ponpes;
                $response['univ'] = $request->univ;
                $response['fakultas'] = $request->fakultas;
                $response['jurusan'] = $request->jurusan;
                $response['semester'] = $request->semester;
                $response['ayah'] = $request->ayah;
                $response['umur_ayah'] = $request->umur_ayah;
                $response['pendidikan_terakhir_ayah'] = $request->pendidikan_terakhir_ayah;
                $response['pekerjaan_ayah'] = $request->pekerjaan_ayah;
                $response['ibu'] = $request->ibu;
                $response['umur_ibu'] = $request->umur_ibu;
                $response['pendidikan_terakhir_ibu'] = $request->pendidikan_terakhir_ibu;
                $response['pekerjaan_ibu'] = $request->pekerjaan_ibu;
                
                $view = View::make('frontend.psb.psb-print')->with(compact('data'));
                return $view;
                
                $response['notification'] = "Register Success";
                $response['status'] = "success";
        }

        
        // echo json_encode($response);
    }
}