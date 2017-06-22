<?php

namespace App\Http\Controllers\Backend\Admin\Bimtes;


use App\Models\User;
use App\Models\AuditrailLog;
use App\Models\BimtesRegister;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Admin\BaseController;

use Mail;
use Excel;
use Config;
use Sentinel;

class BimtesRegisterController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // parent::__construct($model);
        // $this->middleware('SentinelHasAccess:user-management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.bimtes.indexRegister');
    }

    public function showBimtes(Request $req)
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        $bimtes_reg = BimtesRegister::find($req->id);
        if ($bimtes_reg->photo != ""){
        echo '<div class="form-group">
                <div class="col-md-3"><strong>Photo</strong></div>
                <div class="col-md-9">
                    <strong>:</strong> <img src="'.asset($pathp.'storage/bimtes/photo/').'/'.$bimtes_reg->photo.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Name</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$bimtes_reg->name.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Place Of Birth</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$bimtes_reg->place_of_birth.'
                    </div>
                    <div class="clear"></div>
                </div>';
                $date = explode('-', $bimtes_reg->date_of_birth);
                $date = $date[1].'-'.$date[0].'-'.$date[2];
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Date Of Birth</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.eform_date($date).'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Gender</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$bimtes_reg->gender.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Name</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$bimtes_reg->name.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Address</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$bimtes_reg->address.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Phone</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$bimtes_reg->phone.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Email</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$bimtes_reg->email.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Test Number</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$bimtes_reg->test_number.'
                    </div>
                    <div class="clear"></div>
                </div>';
                if(!empty($bimtes_reg->test_day)){
                    $date2 = explode('-', $bimtes_reg->test_day);
                    $date2 = eform_date($date2[1].'-'.$date2[0].'-'.$date2[2]);
                }else{
                    $date2 = "";
                }
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Test Date</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$date2.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Major</strong></label>
                    <div class="col-md-4">
                        <strong>:</strong> 1. '.$bimtes_reg->major1.'
                        <br><strong>&nbsp;&nbsp;</strong> 2. '.$bimtes_reg->major2.'
                    </div>
                    <div class="clear"></div>
                </div>';
        if ($bimtes_reg->image_confirm != ""){
        echo '<div class="form-group">
                <div class="col-md-3"><strong>Photo</strong></div>
                <div class="col-md-9">
                    <strong>:</strong><a href="'.asset($pathp.'storage/bimtes/bukti/').'/'.$bimtes_reg->image_confirm.'"> <img src="'.asset($pathp.'storage/bimtes/bukti/').'/'.$bimtes_reg->image_confirm.'" class="img-responsive" ></a>
                </div>
            </div>';
        }
        $button_action = '';
        if($bimtes_reg->status == "Not Yet Checked"){
            $button_action .= '
                <a href="javascript:show_form_proccess_approve('.$req->id.')" class="btn btn-success btn-xs mlr5" title="Approve"><i class="fa fa-check fa-fw"></i>Approve</a>    
            ';
        }else{
            $button_action .= '
                <a href="#" class="btn btn-success btn-xs mlr5 disabled" title="Approve"><i class="fa fa-check fa-fw"></i>Approve</a>               
            ';
        }

        echo '<div class="form-group">
                <div class="col-md-3"><strong></strong></div>
                <div class="col-md-9">
                    '.$button_action.'
                </div>
            </div>';
    }

    public function get_data_approval(Request $req){        
        $response = array();

        $response['id'] = $req->id;

        $response['status'] = 'success';
        echo json_encode($response);   
    }

    public function change_status(Request $request)
    {
        $response = array();

        $status = $request->method;

        $u_experience = BimtesRegister::find($request->id);
        $u_experience->status = $status;
        $u_experience->save();

        $response['notification'] = 'Approval Successfully';
        $response['status'] = 'success';

        echo json_encode($response);
    }

    /**
     * Datatables for User Trustee Management.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        return datatables(BimtesRegister::datatablesBimtesRegister(true))
            ->addColumn('action', function ($bimtes) {
                $action =  
                '<a href="javascript:show_bimtes_register('.$bimtes->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                <a onclick="javascript:show_form_delete('.$bimtes->id.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>';

                return $action;

            })
            ->editColumn('photo', function ($user) {
                $pathp = "";

                ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                if ($user->photo != ""){
                return "<img src='".asset($pathp.'storage/bimtes/photo/'.$user->photo)."' class='img-responsive' width='100px'>";  
                }
            })
            ->make(true);
    }

    /*function download file*/
    public function download($type, $from="", $end=""){
        ob_end_clean();
        ob_start();
        
        $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );

        if($from == 'undefined' or $end == 'undefined'){
            $data = BimtesRegister::select('name', 'address', 'place_of_birth', 'date_of_birth','gender','phone','email','slta','slta_th','major1','major2','major3','test_number','test_day')->where('status','Approved')->get();

            $data_send = [];
            $x=0;
            foreach ($data as $key => $value) {
                $data_send[$x]['name'] = $value->name;
                $data_send[$x]['address'] = $value->address;
                $data_send[$x]['place_of_birth'] = $value->place_of_birth;

                $date = explode('-', $value->date_of_birth);
                $date = $date[1].' '.$bulan[(int)$date[0]].' '.$date[2];
                
                $data_send[$x]['date_of_birth'] = $date;
                $data_send[$x]['gender'] = $value->gender;
                $data_send[$x]['phone'] = $value->phone;
                $data_send[$x]['email'] = $value->email;
                $data_send[$x]['slta'] = $value->slta;
                $data_send[$x]['slta_th'] = $value->slta_th;
                $data_send[$x]['major1'] = $value->major1;
                $data_send[$x]['major2'] = $value->major2;
                $data_send[$x]['major3'] = $value->major3;
                $data_send[$x]['test_number'] = $value->test_number;

                if(!empty($value->test_day)){
                    $date_test = explode('-', $value->test_day);
                    $date_test = $date_test[1].' '.$bulan[(int)$date_test[0]].' '.$date_test[2];
                }else{
                    $date_test = "";
                }

                $data_send[$x]['test_day'] = $date_test;
                
                $x++;
            }
        }else{
            $data = BimtesRegister::select('name', 'address', 'place_of_birth', 'date_of_birth','gender','phone','email','slta','slta_th','major1','major2','major3','test_number','test_day')->where('status','Approved');
            $data = $data->whereBetween('bimtes_register.created_at', array($from.' 00:00:00', $end.' 23:59:59'));
            $data = $data->get();

            $data_send = [];
            $x=0;
            foreach ($data as $key => $value) {
                $data_send[$x]['name'] = $value->name;
                $data_send[$x]['address'] = $value->address;
                $data_send[$x]['place_of_birth'] = $value->place_of_birth;

                $date = explode('-', $value->date_of_birth);
                $date = $date[1].' '.$bulan[(int)$date[0]].' '.$date[2];
                
                $data_send[$x]['date_of_birth'] = $date;
                $data_send[$x]['gender'] = $value->gender;
                $data_send[$x]['phone'] = $value->phone;
                $data_send[$x]['email'] = $value->email;
                $data_send[$x]['slta'] = $value->slta;
                $data_send[$x]['slta_th'] = $value->slta_th;
                $data_send[$x]['major1'] = $value->major1;
                $data_send[$x]['major2'] = $value->major2;
                $data_send[$x]['major3'] = $value->major3;
                $data_send[$x]['test_number'] = $value->test_number;

                if(!empty($value->test_day)){
                    $date_test = explode('-', $value->test_day);
                    $date_test = $date_test[1].' '.$bulan[(int)$date_test[0]].' '.$date_test[2];
                }else{
                    $date_test = "";
                }

                $data_send[$x]['test_day'] = $date_test;
                
                $x++;
            }
        } 
        
        return Excel::create('Export Data Peserta Bimtes', function($excel) use ($data_send){
            $excel->sheet('Sheet1', function($sheet) use ($data_send)
            {
                $first_header = array('Nama', 'Alamat', 'Tempat Lahir', 'Tanggal Lahir','Jenis Kelamin','Telepon','Email','Sekolah Asal','Tahun Lulus','Pilihan Jurusan 1','Pilihan Jurusan 2','Pilihan Jurusan 3','No. Tes','Tanggal Tes');

                $sheet->setOrientation('landscape');
                $sheet->fromArray($data_send, null, 'A1', true);

                $sheet->row(1, function($row){
                   $row->setFontWeight('bold');
                });

                $sheet->row(1, $first_header);
            });

        })->download($type);
    }

    public function post_bimtes_data(Request $request){
        $response = array();
        $audit = new AuditrailLog;
                    
        $book = BimtesRegister::find($request->bimtes_register_id);

        $audit->email = Sentinel::getUser()->email;
        $audit->action = "Delete";
        $audit->table_name = "Bimtes Register";
        $audit->content = $book->email;
        $audit->save();

        if($book->photo != ""){
            $image_path = public_path().'/storage/bimtes/photo/'.$book->photo;
            unlink($image_path);
        }
        if($book->image_confirm != ""){
            $image_path = public_path().'/storage/bimtes/bukti/'.$book->image_confirm;
            unlink($image_path);
        }

        if ($book->delete()) {
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
        $find_data['table'] = "Delete Bimtes Data";

        /*Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                            $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        });*/

        echo json_encode($response);
    }
}
