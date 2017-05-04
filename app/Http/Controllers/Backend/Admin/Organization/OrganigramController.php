<?php

namespace App\Http\Controllers\Backend\Admin\Organization;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Organigram;
use App\Models\Asrama;
use App\Models\AuditrailLog;
use Sentinel;
use Input;
use Validator;
use Config;

class OrganigramController extends Controller
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
        $asrama = Asrama::select('id','nama_asrama')->get();
        $bidang = Organigram::where('id',1)->get()->first();

        return view('backend.admin.organigram-management.index')
                ->with('asrama',$asrama)
                ->with('bidang',$bidang);
    }

    public function datatables()
    {
         return datatables(Organigram::all())
                ->addColumn('action', function ($organigram) {
                    $action = "";
                    $quote = "'";
                    if($organigram->id == 1 || $organigram->id == 2){
                        $action = '
                    <a href="javascript:show_organigram('.$organigram->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$organigram->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>';
                    }else{
                        $action = '
                    <a href="javascript:show_organigram('.$organigram->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$organigram->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$organigram->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                }
                    return $action;
                })
                ->editColumn('image', function ($organigram) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($organigram->image != ""){
                    return "<img class='center-align' src='".asset($pathp.'storage/organigram/').'/'.$organigram->image."' class='img-responsive' width='100px'>";
                    }
                })
                ->make(true);
    }

    public function get_data(Request $request){

        $response = array();
        $organigramData = Organigram::find($request->id);

        $response['id'] = $organigramData->id;
        echo json_encode($response);
    }

    public function post_organigram(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Organigram";

        if($request->action == 'get-data'){
            $organigram = Organigram::find($request->id);
            $response['nama'] = $organigram->nama;
            $response['image'] = Organigram::getOrganigram($request->id,'image_path');
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'image'   => 'image|mimes:jpeg,jpg,png',
                'nama'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                    if($request->action == 'create'){
                        $organigram = new Organigram;

                        $organigram->asrama_id = $request->nama;
                        $organigram->nama = Asrama::where('id',$request->nama)->get()->first()->nama_asrama;

                        $audit->action = "New";
                        $audit->content = $request->image.' | '.$request->nama;

                        if($request->hasFile('image')) {
                            if($request->action == 'update'){
                                if($organigram->image != ""){
                                $image_path = public_path().'/storage/organigram/'.$organigram->image;
                                unlink($image_path);
                                }
                            }
                            createdirYmd('storage/organigram');
                            $file = Input::file('image');
                            $name = str_random(20). '-' .$file->getClientOriginalName();
                            $organigram->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                            $file->move(public_path().'/storage/organigram/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                        }
                    }else{
                        $organigram = Organigram::find($request->organigram_id);

                        $audit->action = "Edit";
                        $audit->before = $organigram->image.' | '.$organigram->nama;
                        $audit->after = $request->image.' | '.$request->nama;

                        if($request->status_center == "hostel"){
                            $organigram->asrama_id = $request->nama_asrama;
                            $organigram->nama = Asrama::where('id',$request->nama_asrama)->get()->first()->nama_asrama;
                        } else {
                            $organigram->nama = $request->nama;
                        }

                        if($request->hasFile('image')) {
                            if($request->action == 'update'){
                                if($organigram->image != ""){
                                $image_path = public_path().'/storage/organigram/'.$organigram->image;
                                unlink($image_path);
                                }
                            }
                            createdirYmd('storage/organigram');
                            $file = Input::file('image');
                            $name = str_random(20). '-' .$file->getClientOriginalName();
                            $organigram->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                            $file->move(public_path().'/storage/organigram/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                        }
                    }

                    $organigram->save();
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
            $organigram = Organigram::find($request->organigram_id);

            $audit->action = "Delete";
            $audit->content = $organigram->image.' | '.$organigram->nama;
            $audit->save();

            if ($organigram->delete()) {
                        $response['notification'] = 'Delete Data Success';
                        $response['status'] = 'success';
            } else {
                        $response['notification'] = 'Delete Data Failed';
                        $response['status'] = 'failed';
            }
        }
        echo json_encode($response);
    }

    public function show(Request $req)
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        $organigram = Organigram::find($req->id);
        if ($organigram->image != ""){
        echo '<div class="form-group">
                <div class="col-md-2"><strong>Image</strong></div>
                <div class="col-md-9">
                    <strong>:</strong> <img src="'.asset($pathp.'/storage/organigram/').'/'.$organigram->image.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-md-2 control-label"><strong>Name</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$organigram->nama.'
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}
