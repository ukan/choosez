<?php

namespace App\Http\Controllers\Backend\Admin\Mos;


use App\Models\Mos;
use App\Models\AuditrailLog;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Admin\BaseController;

use Mail;
use Excel;
use Config;
use Sentinel;
use Validator;

class MosController extends BaseController
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
        return view('backend.admin.mos.index');
    }

    public function showMos(Request $req)
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        $mos_reg = Mos::find($req->id);

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Name</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->name.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Place Of Birth</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->place_of_birth.'
                    </div>
                    <div class="clear"></div>
                </div>';
                $date = explode('-', $mos_reg->date_of_birth);
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
                        <strong>:</strong> '.$mos_reg->gender.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Address</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->address.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Email</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->email.'
                    </div>
                    <div class="clear"></div>
                </div>';
        
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Dormitory</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->dorm.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Room</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->room.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Major</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->major.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Phone</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->phone.'
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Tshirt Size</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$mos_reg->tsirt_size.'
                    </div>
                    <div class="clear"></div>
                </div>';
         echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Event</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong><br> - <b>Taaruf</b> : '.$mos_reg->taaruf.'
                        <br> - <b>LPKS</b> : '.$mos_reg->lpks.'
                    </div>
                    <div class="clear"></div>
                </div>';
        
        if ($mos_reg->image_confirm != ""){
        echo '<div class="form-group">
                <div class="col-md-3"><strong>Confirmation</strong></div>
                <div class="col-md-9">
                    <strong>:</strong><a href="'.asset($pathp.'storage/mos/').'/'.$mos_reg->image_confirm.'"> <img src="'.asset($pathp.'storage/mos/').'/'.$mos_reg->image_confirm.'" class="img-responsive" ></a>
                </div>
            </div>';
        }
        $button_action = '';
        if($mos_reg->status == "Not Yet Checked"){
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

        $mos_reg = Mos::find($request->id);
        $mos_reg->status = $status;
        $mos_reg->save();

        $audit = new AuditrailLog;

        $audit->email = Sentinel::getUser()->email;
        $audit->action = "Change Status";
        $audit->table_name = "Mos";
        $audit->content = $mos_reg->status;
        $audit->save();

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
        return datatables(Mos::datatables(true))
            ->addColumn('action', function ($mos) {
                $action =  
                '<a href="javascript:show_mos_register('.$mos->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                <a onclick="javascript:show_form_delete('.$mos->id.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>';

                return $action;

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
            $data = Mos::select('name', 'address', 'place_of_birth', 'date_of_birth','gender','dorm','room','major','email','phone','tsirt_size','taaruf','lpks')->where('status','Approved')->get();

            $data_send = [];
            foreach ($data as $key => $value) {
                $data_sen['name'] = $value->name;
                $data_sen['address'] = $value->address;
                $data_sen['place_of_birth'] = $value->place_of_birth;

                $date = explode('-', $value->date_of_birth);
                $date = $date[1].' '.$bulan[(int)$date[0]].' '.$date[2];
                
                $data_sen['date_of_birth'] = $date;
                $data_sen['gender'] = $value->gender;
                $data_sen['dorm'] = $value->dorm;
                $data_sen['room'] = $value->room;
                $data_sen['major'] = $value->major;
                $data_sen['email'] = $value->email;
                $data_sen['phone'] = $value->phone;
                $data_sen['tsirt_size'] = $value->tsirt_size;
                $data_sen['taaruf'] = $value->taaruf;
                $data_sen['lpks'] = $value->lpks;
                
                array_push($data_send, $data_sen);
            }
        }else{
            $data = Mos::select('name', 'address', 'place_of_birth', 'date_of_birth','gender','dorm','room','major','email','phone','tsirt_size','taaruf','lpks')->where('status','Approved');
            $data = $data->whereBetween('mos.created_at', array($from.' 00:00:00', $end.' 23:59:59'));
            $data = $data->get();

            $data_send = [];
            foreach ($data as $key => $value) {
                $data_sen['name'] = $value->name;
                $data_sen['address'] = $value->address;
                $data_sen['place_of_birth'] = $value->place_of_birth;

                $date = explode('-', $value->date_of_birth);
                $date = $date[1].' '.$bulan[(int)$date[0]].' '.$date[2];
                
                $data_sen['date_of_birth'] = $date;
                $data_sen['gender'] = $value->gender;
                $data_sen['dorm'] = $value->dorm;
                $data_sen['room'] = $value->room;
                $data_sen['major'] = $value->major;
                $data_sen['email'] = $value->email;
                $data_sen['phone'] = $value->phone;
                $data_sen['tsirt_size'] = $value->tsirt_size;
                $data_sen['taaruf'] = $value->taaruf;
                $data_sen['lpks'] = $value->lpks;
                
                array_push($data_send, $data_sen);
            }
        } 
        
        return Excel::create("Export Data Peserta Ta'aruf", function($excel) use ($data_send){
            $excel->sheet('Sheet1', function($sheet) use ($data_send)
            {
                $first_header = array('Nama', 'Alamat', 'Tempat Lahir', 'Tanggal Lahir','Jenis Kelamin','Asrama','Kamar','Jurusan','Email','Telepon','Ukuran Baju',"Ta'aruf", 'LPKS');

                $sheet->setOrientation('landscape');
                $sheet->fromArray($data_send, null, 'A1', true);

                $sheet->row(1, function($row){
                   $row->setFontWeight('bold');
                });

                $sheet->row(1, $first_header);
            });

        })->download($type);
    }

    public function post_mos_data(Request $request){
        $response = array();
        $audit = new AuditrailLog;
                    
        $book = Mos::find($request->mos_register_id);

        $audit->email = Sentinel::getUser()->email;
        $audit->action = "Delete";
        $audit->table_name = "Mos";
        $audit->content = $book->email;
        $audit->save();

        if($book->image_confirm != ""){
            $image_path = public_path().'/storage/mos/'.$book->image_confirm;
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
        $find_data['table'] = "Delete Mos Data";

        // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
        //             $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
        //             $message->to("ukansaokani@gmail.com", $find_data['full_name'])->subject('Admin Delete Data');
        //         });

        echo json_encode($response);
    }

    public function resetPassword(){

        $data['form']['route'] = 'admin-update-user-manual';
        $data['form']['method'] = 'POST';

        return view('backend.admin.mos.form', $data)->with('title', 'Reset Password')->with('pass', null);
    }

    public function resetPasswordUser(Request $request)
    {   
        $response = array();
        $param = $request->all();

        $rules = array( 
            'email'   => 'required|email',
        );

        $message = [
            'email.required' => 'Email wajib diisi',
        ];

        $validate = Validator::make($param,$rules);
        if($validate->fails()) {
            $this->validate($request,$rules, $message);
        } else {
            $data['form']['route'] = 'admin-update-user-manual';
            $data['form']['method'] = 'POST';

            $password = "";
            for ($i = 0; $i<8; $i++) 
            {
                $password .= mt_rand(0,9);
            }

            $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
            $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$password, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
            $sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);

            $userMos = Mos::where('email', strtolower($request->email))->first();
            
            if(!empty($userMos)){
                $userMos->password = $sentEncrypt;
                $userMos->save();
            }else{
                $route_login_type = "admin-index-mos-user-edit";
                $backToLogin = redirect()->route($route_login_type)->withInput();
                flash()->error('Email not found, please try again!');

                return $backToLogin;
            }
        }

        return view('backend.admin.mos.form', $data)->with('title', 'user-edit')->with('pass', $password);
    }
}