<?php

namespace App\Http\Controllers\Backend\Admin\Gallery;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Album;
use App\Models\Gallery;
use App\Models\AuditrailLog;
use Input;
use Validator;
use Config;
use Sentinel;
use Mail;

class GalleryController extends Controller
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
        return view('backend.admin.gallery-management.index');
    }

    public function indexGallery(Request $req)
    {
        $data = Album::select('id','name')->get();
        return view('backend.admin.gallery-management.gallery')->with('album', $data);
    }

    public function datatables()
    {
         return datatables(Album::all())
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
                    return "<img class='center-align' src='".asset($pathp.'storage/gallery/').'/'.$data->image."' class='img-responsive' width='100px'>";
                    }
                })
                ->make(true);
    }

    public function datatablesGallery()
    {
        $eloq = Gallery::select('gallery.id', 'album.name', 'gallery.image')
                    ->join('album','album.id','=','gallery.album_id')
                    ->get();
         return datatables($eloq)
                ->addColumn('action', function ($data) {
                    $action = "";
                    $quote = "'";
                        $action = '
                    <a href="javascript:show_data('.$data->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$data->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                    return $action;
                })
                ->editColumn('image', function ($data) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($data->image != ""){
                    return "<img class='center-align' src='".asset($pathp.'storage/gallery/').'/'.$data->image."' class='img-responsive' width='100px'>";
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

    public function get_dataPhoto(Request $request){

        $response = array();
        $data = Gallery::find($request->id);

        $response['id'] = $data->id;
        echo json_encode($response);
    }

    public function post_album(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Album";
        
        if($request->action == 'get-data'){
            $data = Album::find($request->id);
            $response['name'] = $data->name;
            $response['date'] = $data->date;
            $response['link_donwload'] = $data->link_donwload;
            $response['image'] = Album::getAlbum($request->id,'image_path');
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'image'   => 'image|mimes:jpeg,jpg,png',
                'name'   => 'required',
                'date'   => 'required',
                'link_donwload'   => 'required',
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
                        $find_data['table'] = "Create Album";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                        $data = new Album;

                        $data->name = $request->name;
                        $data->date = $request->date;
                        $data->link_donwload = $request->link_donwload;

                        $audit->action = "New";
                        $audit->content = $request->image.' | '.$request->name.' | '.$request->date.' | '.$request->link_donwload;


                        if($request->hasFile('image')) {
                            if($request->action == 'update'){
                                if($data->image != ""){
                                $image_path = public_path().'/storage/gallery/'.$data->image;
                                unlink($image_path);
                                }
                            }
                            createdirYmd('storage/gallery');
                            $file = Input::file('image');
                            $name = str_random(20). '-' .$file->getClientOriginalName();
                            $data->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                            $file->move(public_path().'/storage/gallery/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                        }
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Album";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                        $data = Album::find($request->data_id);
                        $data->name = $request->name;
                        $data->date = $request->date;
                        $data->link_donwload = $request->link_donwload;

                        $audit->action = "Edit";
                        $audit->before = $data->image.' | '.$data->name.' | '.$data->date.' | '.$data->link_donwload;
                        $audit->after = $request->image.' | '.$request->name.' | '.$request->date.' | '.$request->link_donwload;

                        if($request->hasFile('image')) {
                            if($request->action == 'update'){
                                if($data->image != ""){
                                $image_path = public_path().'/storage/gallery/'.$data->image;
                                unlink($image_path);
                                }
                            }
                            createdirYmd('storage/gallery');
                            $file = Input::file('image');
                            $name = str_random(20). '-' .$file->getClientOriginalName();
                            $data->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                            $file->move(public_path().'/storage/gallery/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                        }
                    }
                    $audit->save();

                    $data->save();
                    if($request->action == 'create'){
                        $response['notification'] = 'Success Create Data';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Success Update Data';
                        $response['status'] = 'success';
                    }
            }
        }else{
            $data = Album::find($request->data_id);

            $audit->action = "Delete";
            $audit->content = $data->image.' | '.$data->name.' | '.$data->date.' | '.$data->link_donwload;
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
            $find_data['table'] = "Delete Album";

            Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                            });
        }

        echo json_encode($response);
    }

    public function post_photo(Request $request){
        $response = array();
        
        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Gallery";

        if($request->action == 'get-data-photo'){
            $data = Album::find($request->id);
            $response['name'] = $data->name;
            $response['date'] = $data->date;
            $response['image'] = Album::getAlbum($request->id,'image_path');
        }else if($request->action != 'delete'){
            $param = $request->all();
            $rules = array(
                'image'   => 'required',
                'album_name'   => 'required|not_in:Select Album',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                    if($request->action == 'create'){
                        foreach ($request->image as $key => $value) {
                            $data = new Gallery;
                            $data->album_id = $request->album_name;

                            $audit->action = "New";
                            $audit->content = $request->image[$key].' | '.$request->album_name;

                            if($request->hasFile('image')) {
                                createdirYmd('storage/gallery');
                                $file = $request->image[$key];
                                $name = str_random(20). '-' .$file->getClientOriginalName();
                                $data->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                                $file->move(public_path().'/storage/gallery/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                            }
                            $data->save();
                            $audit->save();
                        }

                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Create Photo";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                    }

                    if($request->action == 'create'){
                        $response['notification'] = 'Success Create Data';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Success Update Data';
                        $response['status'] = 'success';
                    }
            }
        }else{
            $data = Gallery::find($request->data_id);

            $audit->action = "Delete";
            $audit->content = $data->image.' | '.$data->album_name;
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
            $find_data['table'] = "Delete Photo";

            Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                            });
        }
        echo json_encode($response);
    }

    public function show(Request $req)
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        $data = Album::find($req->id);
        if ($data->image != ""){
        echo '<div class="form-group">
                <div class="col-md-3"><strong>Tumbnail</strong></div>
                <div class="col-md-9">
                    <strong>:</strong> <img src="'.asset($pathp.'/storage/gallery/').'/'.$data->image.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Album Name</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$data->name.'
                    </div>
                    <div class="clear"></div>
                </div>';

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Date</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$data->date.'
                    </div>
                    <div class="clear"></div>
                </div>';

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Link Download</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$data->link_donwload.'
                    </div>
                    <div class="clear"></div>
                </div>';
    }

    public function showPhoto(Request $req)
    {
        $data = Gallery::select('gallery.id', 'album.name', 'gallery.image')
                    ->join('album','album.id','=','gallery.album_id')
                    ->where('gallery.id',$req->id)
                    ->get()->first();
        if ($data->image != ""){
        echo '<div class="form-group">
                <div class="col-md-3"><strong>Image</strong></div>
                <div class="col-md-9">
                    <strong>:</strong> <img src="'.asset('storage/gallery/').'/'.$data->image.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-md-3 control-label"><strong>Album Name</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$data->name.'
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}
