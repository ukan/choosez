<?php

namespace App\Http\Controllers\Backend\Admin\Organization;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Kementerian;
use App\Models\Bidang;
use App\Models\AuditrailLog;
use Sentinel;
use Input;
use Validator;
use Mail;

class KementerianController extends Controller
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
        $bidang = Bidang::select('id','nama_bidang')
                    ->where('id', '!=', 1)
                    ->where('id', '!=', 2)
                    ->get();
        
        return view('backend.admin.ministry-management.index')->with('bidang',$bidang);
    }

    public function datatables()
    {
        $eloq = Kementerian::selectRaw('kementerian.id,
                                        bidang.nama_bidang,
                                        kementerian.menteri,
                                        kementerian.sekretaris,
                                        kementerian.bendahara')
                 ->leftJoin('bidang','bidang.id','=','kementerian.bidang_id')
                 ->orderBy('kementerian.id')->get();

         return datatables($eloq)
                ->addColumn('action', function ($kementerian) {
                    $quote = "'";
                    return
                    ' 
                    <a href="javascript:show_kementerian('.$kementerian->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$kementerian->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$kementerian->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>'
                    ;
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $kementerianData = Book::find($request->id);   

        $response['id'] = $kementerianData->id;
        echo json_encode($response);   
    }

    public function post_kementerian(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Ministry";

        if($request->action == 'get-data'){
            $kementerian = Kementerian::find($request->id);
            $response['bidang'] = $kementerian->bidang_id;
            $response['menteri'] = $kementerian->menteri;            
            $response['sekretaris'] = $kementerian->sekretaris;
            $response['bendahara'] = $kementerian->bendahara;            
            $response['anggota'] = $kementerian->anggota;            
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'bidang'   => 'required',
                'menteri'   => 'required',
                'sekretaris'   => 'required',
                'bendahara'   => 'required',
                'anggota'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                    if($request->action == 'create'){
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Create Kementrian";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                        $kementerian = new Kementerian;

                        $audit->action = "New";
                        $audit->content = $request->bidang.' | '.$request->menteri.' | '.$request->sekretaris.' | '.$request->bendahara.' | '.$request->anggota;
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Kementrian";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                        $kementerian = Kementerian::find($request->kementerian_id);

                        $audit->action = "Edit";
                        $audit->before = $kementerian->bidang_id.' | '.$kementerian->menteri.' | '.$kementerian->sekretaris.' | '.$kementerian->bendahara.' | '.$kementerian->anggota;                    
                        $audit->after = $request->bidang.' | '.$request->menteri.' | '.$request->sekretaris.' | '.$request->bendahara.' | '.$request->anggota;                    
                    }
                    $kementerian->bidang_id = $request->bidang;
                    $kementerian->menteri = $request->menteri;
                    $kementerian->sekretaris = $request->sekretaris;
                    $kementerian->bendahara = $request->bendahara;
                    $kementerian->anggota = $request->anggota;
              
                    $kementerian->save();
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
            $kementerian = Kementerian::find($request->kementerian_id);

            $audit->action = "Delete";
            $audit->content = $kementerian->bidang_id.' | '.$kementerian->menteri.' | '.$kementerian->sekretaris.' | '.$kementerian->bendahara.' | '.$kementerian->anggota;
            $audit->save();

            if ($kementerian->delete()) {
                        $response['notification'] = 'Delete Data Success';
                        $response['status'] = 'success';
            } else {
                        $response['notification'] = 'Delete Data Failed';
                        $response['status'] = 'failed';
            }

            $data = Sentinel::getUser()->first_name;
            $find_data['email'] = "x";
            $find_data['id'] = "cek";
            $find_data['full_name'] = $data;
            $find_data['table'] = "Delete Kementrian";

            Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                            });
        }

        echo json_encode($response);
    }

    public function show(Request $req)
    {
        $kementerian = Kementerian::selectRaw('
                                        kementerian.id,
                                        bidang.nama_bidang,
                                        kementerian.menteri,
                                        kementerian.sekretaris,
                                        kementerian.anggota,
                                        kementerian.bendahara')
                 ->leftJoin('bidang','bidang.id','=','kementerian.bidang_id')
                 ->where('kementerian.id','=',$req->id)
                 ->get()->first();

        echo '<div class="form-group">
                    <label class="col-lg-2 control-label">Bidang</label>
                    <div class="col-lg-9">
                        : '.$kementerian->nama_bidang.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-2 control-label">Menteri</label>
                    <div class="col-lg-9">
                        : '.$kementerian->menteri.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-2 control-label">Sekretaris</label>
                    <div class="col-lg-9">
                        : '.$kementerian->sekretaris.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-2 control-label">Bendahara</label>
                    <div class="col-lg-9">
                        : '.$kementerian->bendahara.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-2 control-label">Anggota</label>
                    <div class="col-lg-9">
                        : '.$kementerian->anggota.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}