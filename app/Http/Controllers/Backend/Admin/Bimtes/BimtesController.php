<?php

namespace App\Http\Controllers\Backend\Admin\Bimtes;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Bimtes;
use App\Models\AuditrailLog;
use Sentinel;
use Input;
use Validator;
use Config;
use Mail;

class BimtesController extends Controller
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
        return view('backend.admin.bimtes.index');
    }

    public function datatables()
    {
         return datatables(Bimtes::all())
                ->addColumn('action', function ($bimtes) {
                    $quote = "'";
                    return 
                        '<a href="javascript:show_bimtes('.$bimtes->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                        <a onclick="javascript:show_form_update('.$quote.$bimtes->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>'
                        ;
                })
                ->editColumn('content', function ($bimtes) {
                        return str_limit($bimtes->content, 150);  
                })
                ->make(true);
    }

    public function post_bimtes(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Bimtes";

        if($request->action == 'get-data'){
            $bimtes_data = Bimtes::find($request->id);
            $response['title'] = $bimtes_data->title;
            $response['content'] = $bimtes_data->content;
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'title'   => 'required',
                'content'   => 'required',
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
                        $find_data['table'] = "Create Bulletin";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                        $bimtes_data = new Bimtes;

                        $audit->action = "New";
                        $audit->content = $request->title.' | '.$request->content;
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Bulletin";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                        $bimtes_data = Bimtes::find($request->bimtes_id);

                        $audit->action = "Edit";
                        $audit->before = $bimtes_data->title.' | '.$bimtes_data->content;                    
                        $audit->after = $request->title.' | '.$request->content;                    
                    }
                    $bimtes_data->title = $request->title;
                    $bimtes_data->content = $request->content;
              
                    $bimtes_data->save();
                    $audit->save();

                    if($request->action == 'create'){
                        $response['notification'] = 'Create Data Successfully';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Update Data Successfully';
                        $response['status'] = 'success';
                    }
            }
        }else{            
            $bimtes_data = Bimtes::find($request->bimtes_data_id);
            $audit->action = "Delete";
            $audit->content = $request->title.' | '.$request->content;
            $audit->save();
                        
            if ($bimtes_data->delete()) {
                        $response['notification'] = 'Delete Data Successfully';
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

        $bimtes_data = Bimtes::find($req->id);

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Title</label>
                    <div class="col-lg-9">
                        '.$bimtes_data->title.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Content</label>
                    <div class="col-lg-9">
                        '.$bimtes_data->content.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}
