<?php

namespace App\Http\Controllers\Backend\Admin\Organization;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Proker;
use App\Models\Bidang;
use App\Models\Kementerian;
use App\Models\Organigram;
use App\Models\AuditrailLog;
use Sentinel;
use Input;
use Validator;
use Mail;
use Illuminate\Config\Repository as IlluminateConfig;

class ProkerController extends Controller
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

    public function index(Request $req)
    {
        $bidang = Bidang::select('id','nama_bidang')->get();
        
        return view('backend.admin.proker-management.index')->with('bidang',$bidang);
    }

    public function datatables()
    {
        $eloq = Proker::selectRaw('proker.id,
                                    bidang.nama_bidang,
                                    proker.proker_bulanan')
                 ->leftJoin('bidang','bidang.id','=','proker.bidang_id')
                 ->orderBy('proker.id')->get();

         return datatables($eloq)
                ->addColumn('action', function ($proker) {
                    $quote = "'";
                    return
                    ' 
                    <a href="javascript:show_proker('.$proker->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$proker->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$proker->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>'
                    ;
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $prokerData = Book::find($request->id);   

        $response['id'] = $prokerData->id;
        echo json_encode($response);   
    }

    public function post_proker(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Proker";

        if($request->action == 'get-data'){
            $proker = Proker::find($request->id);
            $response['bidang'] = $proker->bidang_id;
            $response['proker_mingguan'] = $proker->proker_mingguan;            
            $response['proker.bulanan'] = $proker->proker_bulanan;
            $response['proker_tahunan'] = $proker->proker_tahunan;            
            $response['proker_kondisional'] = $proker->proker_kondisional;            
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'bidang'   => 'required',
                'proker_mingguan'   => 'required',
                'proker_bulanan'   => 'required',
                'proker_tahunan'   => 'required',
                'proker_kondisional'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                    if($request->action == 'create'){
                        $proker = new Proker;

                        $audit->action = "New";
                        $audit->content = $request->bidang.' | '.$request->proker_mingguan.' | '.$request->proker_bulanan.' | '.$request->proker_tahunan.' | '.$request->proker_kondisional;
                    }else{
                        $proker = Proker::find($request->proker_id);

                        $audit->action = "Edit";
                        $audit->before = $proker->bidang_id.' | '.$proker->proker_mingguan.' | '.$proker->proker_bulanan.' | '.$proker->proker_tahunan.' | '.$proker->proker_kondisional;                    
                        $audit->after = $request->bidang.' | '.$request->proker_mingguan.' | '.$request->proker_bulanan.' | '.$request->proker_tahunan.' | '.$request->proker_kondisional;                    
                    }
                    $proker->bidang_id = $request->bidang;
                    $proker->proker_mingguan = $request->proker_mingguan;
                    $proker->proker_bulanan = $request->proker_bulanan;
                    $proker->proker_tahunan = $request->proker_tahunan;
                    $proker->proker_kondisional = $request->proker_kondisional;
              
                    $proker->save();
                    $audit->save();

                    if($request->action == 'create'){
                        $response['notification'] = 'Success Create Data';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Success Update Data';
                        $response['status'] = 'success';
                    }
            }
        }else{            
            $proker = Proker::find($request->proker_id);

            $audit->action = "Delete";
            $audit->content = $request->bidang.' | '.$request->proker_mingguan.' | '.$request->proker_bulanan.' | '.$request->proker_tahunan.' | '.$request->proker_kondisional;
            $audit->save();

            if ($proker->delete()) {
                        $response['notification'] = 'Delete Data Success';
                        $response['status'] = 'success';
            } else {
                        $response['notification'] = 'Delete Data Failed';
                        $response['status'] = 'failed';
            }
        }

        $data = Sentinel::getUser()->first_name;
        $find_data['email'] = "x";
        $find_data['id'] = "cek";
        $find_data['full_name'] = $data;
        $find_data['table'] = "Slider";

        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        });
        
        echo json_encode($response);
    }

    public function show(Request $req)
    {
        $proker = Proker::selectRaw('
                                    proker.id,
                                    bidang.nama_bidang,
                                    proker.proker_mingguan,
                                    proker.proker_bulanan,
                                    proker.proker_tahunan,
                                    proker.proker_kondisional')
                 ->leftJoin('bidang','bidang.id','=','proker.bidang_id')
                 ->where('proker.id','=',$req->id)
                 ->get()->first();

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Bidang</label>
                    <div class="col-lg-9">
                        : '.$proker->nama_bidang.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Proker Mingguan</label>
                    <div class="col-lg-9">
                        : '.$proker->proker_mingguan.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Proker Bulanan</label>
                    <div class="col-lg-9">
                        : '.$proker->proker_bulanan.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Proker Tahunan</label>
                    <div class="col-lg-9">
                        : '.$proker->proker_tahunan.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Proker Kondisional</label>
                    <div class="col-lg-9">
                        : '.$proker->proker_kondisional.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }

    public function showData(Request $req)
    {
        $proker = Proker::selectRaw('
                                    proker.id,
                                    bidang.nama_bidang,
                                    proker.proker_mingguan,
                                    proker.proker_bulanan,
                                    proker.proker_tahunan,
                                    proker.proker_kondisional')
                 ->leftJoin('bidang','bidang.id','=','proker.bidang_id')
                 ->where('proker.bidang_id','=',$req->id)
                 ->get()->first();
        $kementerian = Kementerian::selectRaw('
                                        kementerian.id,
                                        bidang.nama_bidang,
                                        kementerian.menteri,
                                        kementerian.sekretaris,
                                        kementerian.anggota,
                                        kementerian.bendahara')
                 ->leftJoin('bidang','bidang.id','=','kementerian.bidang_id')
                 ->where('kementerian.bidang_id','=',$req->id)
                 ->get()->first();

        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Bidang</label>
                    <div class="col-lg-8">
                        : '.$kementerian->nama_bidang.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Menteri</label>
                    <div class="col-lg-8">
                        : '.$kementerian->menteri.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Sekretaris</label>
                    <div class="col-lg-8">
                        : '.$kementerian->sekretaris.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Bendahara</label>
                    <div class="col-lg-8">
                        : '.$kementerian->bendahara.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Anggota</label>
                    <div class="col-lg-8">
                        : '.$kementerian->anggota.'                        
                    </div>
                    <div class="clear"></div>
                </div>';

        echo '<hr>';
        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Proker Mingguan</label>
                    <div class="col-lg-8">
                        : '.$proker->proker_mingguan.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Proker Bulanan</label>
                    <div class="col-lg-8">
                        : '.$proker->proker_bulanan.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Proker Tahunan</label>
                    <div class="col-lg-8">
                        : '.$proker->proker_tahunan.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-4 control-label">Proker Kondisional</label>
                    <div class="col-lg-8">
                        : '.$proker->proker_kondisional.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }

    public function showDataWilayah(Request $req, IlluminateConfig $config)
    {
        $pathp = "";

        (($config->get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        $organigram = Organigram::select('id','image')
                 ->where('id',$req->id)
                 ->get()->first();

        echo '<div class="center">
                <img style="width: 980px;height: 600" src="'.asset($pathp.'storage/organigram/'.$organigram->image).'">
              </div>';
    }
}