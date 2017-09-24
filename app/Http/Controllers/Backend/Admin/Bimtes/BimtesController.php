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
            $response['pamphlet'] = $bimtes_data->pamflet;
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'title'   => 'required',
                'content'   => 'required',
                'image'   => 'required|image',
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
                        $find_data['table'] = "Create Bimtes";

                        // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                        //                     $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                        //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        //                 });

                        $bimtes_data = new Bimtes;

                        $audit->action = "New";
                        $audit->content = $request->title.' | '.$request->content;
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Bimtes";

                        // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                        //                     $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                        //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        //                 });

                        $bimtes_data = Bimtes::find($request->bimtes_id);

                        $audit->action = "Edit";
                        $audit->before = $bimtes_data->title.' | '.$bimtes_data->content.' | '.$bimtes_data->pamflet;                    
                        $audit->after = $request->title.' | '.$request->content.' | '.$request->image;                    
                    }
                    $bimtes_data->title = $request->title;
                    $bimtes_data->content = $request->content;
                    
                    $fileOverLoad = "";
                    if($request->hasFile('image')) {
                        if(filesize(Input::file('image'))<=1500000){
                            if($request->action == 'update'){                        
                                if($bimtes_data->pamflet != ""){  
                                    $image_path = public_path().'/storage/bimtes/'.$bimtes_data->pamflet;
                                    if(file_exists($image_path))
                                        unlink($image_path);
                                }
                            }
                            // createdirYmd('storage/bimtes');
                            $file = Input::file('image');            
                            $name = str_random(20). '-' .$file->getClientOriginalName();  
                            $bimtes_data->pamflet = date("Y")."/".date("m")."/".date("d")."/".$name;          
                            // $file->move(public_path().'/storage/bimtes/'.date("Y")."/".date("m")."/".date("d")."/", $name);

                            $path = public_path('/storage/bimtes/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                            resizeAndSaveImage($file, $path);
                        }else{
                            $overload = "overload";
                        }
                    }

                    if($request->action == 'create' && empty($fileOverLoad)){
                        $bimtes_data->save();
                        $audit->save();

                        $response['notification'] = 'Create Data Successfully';
                        $response['status'] = 'success';
                    }else if($request->action == 'update' && empty($fileOverLoad)){
                        $bimtes_data->save();
                        $audit->save();

                        $response['notification'] = 'Update Data Successfully';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Upload file size must be less than 1 Mb';
                        $response['status'] = 'failed';
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
                    <label class="col-lg-2 control-label">Title</label>
                    <div class="col-lg-10">
                        '.$bimtes_data->title.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-2 control-label">Content</label>
                    <div class="col-lg-10">
                        '.$bimtes_data->content.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        if ($bimtes_data->pamflet != ""){
        echo '<div class="form-group">
                <div class="col-lg-2">Pamphlet</div>
                <div class="col-lg-10">
                    <img src="'.asset($pathp.'/storage/bimtes/').'/'.$bimtes_data->pamflet.'" class="img-responsive" >
                </div>
            </div>';
        }
    }
}
