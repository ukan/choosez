<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RegisterStudent;
use App\Models\Slider;
use App\Models\Bimtes;
use Illuminate\Http\Request;
use Validator;
use View;

class BimtesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        $slider = Slider::where('category', 'Bimtes')->get();
        $bimtes = Bimtes::get();

        return view('frontend.bimtes.index')
                 ->with('slider', $slider)
                 ->with('bimtes', $bimtes);
    }

    public function indexFacilities()
    {   
        return view('frontend.facilities.index');
    }

    public function psbPrint()
    {   
        return view('frontend.psb.psb-print');
    }

    public function store(Request $request)
    {   
        $response = array();
        $param = $request->all();

        $rules = array( 
            // 'nama'   => 'required',
            // 'nama_panggilan'   => 'required',
        );
        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules);
        } else {
                $registerStudent = new RegisterStudent;

                $registerStudent->name = $request->nama;
                $registerStudent->nick_name = $request->nama_panggilan;
                $registerStudent->place_of_birth = $request->tempat_lahir;
                $registerStudent->date_of_birth = $request->tanggal_lahir;
                $registerStudent->address = $request->alamat;
                $registerStudent->rt = $request->rt;
                $registerStudent->rw = $request->rw;
                $registerStudent->village = $request->desa;
                $registerStudent->sub_district = $request->kecamatan;
                $registerStudent->city = $request->kota;
                $registerStudent->province = $request->provinsi;
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
                    'kecamatan' => $request->kecamatan,
                    'kota' => $request->kota,
                    'provinsi' => $request->provinsi,
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

                $view = View::make('frontend.psb.psb-print')->with(compact('data'));
                return $view;
        }
    }
}