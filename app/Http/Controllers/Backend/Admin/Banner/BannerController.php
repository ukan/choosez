<?php

namespace App\Http\Controllers\Backend\Admin\Banner;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\HomepageBanner;
use App\Models\AuditrailLog;

use Input;
use Validator;
use Config;
use Sentinel;
use Mail;

class BannerController extends Controller
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
        return view('backend.admin.banner-management.index');
    }

    public function datatables()
    {
         return datatables(HomepageBanner::all())
                ->addColumn('action', function ($data) {
                    $action = "";
                    $quote = "'";
                        $action = '
                    <a href="javascript:show_data('.$data->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$data->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$data->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                    return $action;
                })
                ->editColumn('image', function ($data) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($data->image != ""){
                    return "<img class='center-align' src='".asset($pathp.'storage/banner/').'/'.$data->image."' class='img-responsive' width='100px'>";
                    }
                })
                ->make(true);
    }

    public function get_data(Request $request){

        $response = array();
        $data = Album::find($request->id);

        $response['id'] = $data->id;
        echo json_encode($response);
    }

    public function post_banner(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Homepage Banner";
        
        if($request->action == 'get-data'){
            $data = HomepageBanner::find($request->id);
            $response['name'] = $data->name;
            $response['image'] = HomepageBanner::getBanner($request->id,'image_path');
            $response['link'] = $data->link;
            $response['indexOrder'] = $data->index_order;
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                // 'name'   => 'required',
                'image'   => 'image|mimes:jpeg,jpg,png',
                // 'link'   => 'required',
                'indexOrder'   => 'required|numeric',
            );

            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                    $isBanner = "";
                    if($request->action == 'create'){

                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Create Banner";

                        // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                        //                     $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                        //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        //                 });

                        $data = new HomepageBanner;

                        $data->name = $request->name;
                        $data->index_order = $request->indexOrder;
                        $data->link = $request->link;

                        $audit->action = "New";
                        $audit->content = $request->image.' | '.$request->name.' | '.$request->indexOrder.' | '.$request->link;

                        $fileOverLoad = "";
                        if($request->hasFile('image')) {
                            if(filesize(Input::file('image'))<=1500000){
                                if($request->action == 'update'){
                                    if($data->image != ""){
                                        $image_path = public_path().'/storage/banner/'.$data->image;
                                        if(file_exists($image_path))
                                            unlink($image_path);
                                    }
                                }
                                // createdirYmd('storage/gallery');
                                $file = Input::file('image');
                                $name = str_random(20). '-' .$file->getClientOriginalName();
                                $data->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                                // $file->move(public_path().'/storage/gallery/'.date("Y")."/".date("m")."/".date("d")."/", $name);

                                $path = public_path('/storage/banner/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                                $isBanner = resizeAndSaveImage($file, $path, $is_banner=TRUE);
                            }else{
                                $overload = "overload";
                            }
                        }
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Banner";

                        // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                        //                     $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                        //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        //                 });

                        $data = HomepageBanner::find($request->data_id);
                        $data->name = $request->name;
                        $data->index_order = $request->indexOrder;
                        $data->link = $request->link;

                        $audit->action = "Edit";
                        $audit->before = $data->image.' | '.$data->name.' | '.$data->index_order.' | '.$data->link;
                        $audit->after = $request->image.' | '.$request->name.' | '.$request->indexOrder.' | '.$request->link;

                        $fileOverLoad = "";
                        if($request->hasFile('image')) {
                            if(filesize(Input::file('image'))<=1500000){
                                if($request->action == 'update'){
                                    if($data->image != ""){
                                        $image_path = public_path().'/storage/banner/'.$data->image;
                                        if(file_exists($image_path))
                                            unlink($image_path);
                                    }
                                }
                                // createdirYmd('storage/gallery');
                                $file = Input::file('image');
                                $name = str_random(20). '-' .$file->getClientOriginalName();
                                $data->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                                // $file->move(public_path().'/storage/gallery/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                                $path = public_path('/storage/banner/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                                $isBanner = resizeAndSaveImage($file, $path, $is_banner=TRUE);
                            }else{
                                $overload = "overload";
                            }
                        }
                    }

                    if(!empty($isBanner)){
                        $response['notification'] = 'Upload image must be landscape';
                        $response['status'] = 'failed';
                    }else if($request->action == 'create' && empty($fileOverLoad)){
                        $audit->save();
                        $data->save();

                        $response['notification'] = 'Success Create Data';
                        $response['status'] = 'success';
                    }else if($request->action == 'update' && empty($fileOverLoad)){
                        $audit->save();
                        $data->save();

                        $response['notification'] = 'Success Update Data';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Upload file size must be less than 1 Mb';
                        $response['status'] = 'failed';
                    }
            }
        }else{
            $data = HomepageBanner::find($request->data_id);

            $audit->action = "Delete";
            $audit->content = $data->image.' | '.$data->name.' | '.$data->index_order.' | '.$data->link;
            $audit->save();

            if ($data->delete()) {
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
            $find_data['table'] = "Delete Banner";

            // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
            //                     $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
            //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
            //                 });
        }

        echo json_encode($response);
    }

    public function show(Request $req)
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        $data = HomepageBanner::find($req->id);
        if ($data->image != ""){
        echo '<div class="form-group">
                <div class="col-md-3"><strong>Image</strong></div>
                <div class="col-md-9">
                    <strong>:</strong> <img src="'.asset($pathp.'/storage/banner/').'/'.$data->image.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Name</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$data->name.'
                    </div>
                    <div class="clear"></div>
                </div>';

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Link</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$data->link.'
                    </div>
                    <div class="clear"></div>
                </div>';

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Index Order</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$data->index_order.'
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}
