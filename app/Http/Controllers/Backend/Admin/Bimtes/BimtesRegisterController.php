<?php

namespace App\Http\Controllers\Backend\Admin\Bimtes;

use Sentinel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BimtesRegister;
use App\Http\Controllers\Backend\Admin\BaseController;
use Mail;
use Config;

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
                $action =  '<a href="javascript:show_bimtes_register('.$bimtes->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>';

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
}
