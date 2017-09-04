<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Slider;
use App\Models\AuditrailLog;
use Sentinel;
use Input;
use Validator;
use Config;
use Mail;

class SliderController extends Controller
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
        return view('backend.admin.slider-management.index');
    }

    public function datatables()
    {
         return datatables(Slider::all())
                ->addColumn('action', function ($slider) {
                    $action = "";
                    $quote = "'";
                    $action = '
                    <a href="javascript:show_slider('.$slider->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$slider->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$slider->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                    return $action;
                })
                ->editColumn('image', function ($slider) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($slider->image != ""){
                    return "<img class='center-align' src='".asset($pathp.'storage/slider/').'/'.$slider->image."' class='img-responsive' width='100px'>";
                    }
                })
                ->make(true);
    }

    public function get_data(Request $request){

        $response = array();
        $organigramData = Slider::find($request->id);

        $response['id'] = $organigramData->id;
        echo json_encode($response);
    }

    public function post_slider(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Slider";

        if($request->action == 'get-data'){
            $organigram = Slider::find($request->id);
            $response['category'] = $organigram->category;
            $response['image'] = Slider::getSlider($request->id,'image_path');
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'image'   => 'image|mimes:jpeg,jpg,png',
                'category'   => 'required',
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
                        $find_data['table'] = "Create Slider";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });
            
                        $organigram = new Slider;

                        $organigram->category = $request->category;

                        $audit->action = "New";
                        $audit->content = $request->image.' | '.$request->category;

                        if($request->hasFile('image')) {
                            if($request->action == 'update'){
                                if($organigram->image != ""){
                                $image_path = public_path().'/storage/slider/'.$organigram->image;
                                unlink($image_path);
                                }
                            }
                            createdirYmd('storage/slider');
                            $file = Input::file('image');
                            $name = str_random(20). '-' .$file->getClientOriginalName();
                            $organigram->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                            // $file->move(public_path().'/storage/slider/'.date("Y")."/".date("m")."/".date("d")."/", $name);

                            $path = public_path('/storage/slider/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                            resizeAndSaveImage($file, $path);
                        }
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Slider";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                        $organigram = Slider::find($request->slider_id);
                        
                        $organigram->category = $request->category;

                        $audit->action = "Edit";
                        $audit->before = $organigram->image.' | '.$organigram->category;
                        $audit->after = $request->image.' | '.$request->category;

                        if($request->hasFile('image')) {
                            if($request->action == 'update'){
                                if($organigram->image != ""){
                                $image_path = public_path().'/storage/slider/'.$organigram->image;
                                unlink($image_path);
                                }
                            }
                            createdirYmd('storage/slider');
                            $file = Input::file('image');
                            $name = str_random(20). '-' .$file->getClientOriginalName();
                            $organigram->image = date("Y")."/".date("m")."/".date("d")."/".$name;
                            // $file->move(public_path().'/storage/slider/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                            $path = public_path('/storage/slider/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                            resizeAndSaveImage($file, $path);
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
            $organigram = Slider::find($request->slider_id);

            $audit->action = "Delete";
            $audit->content = $request->image.' | '.$request->category;
            $audit->save();

            if ($organigram->delete()) {
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
            $find_data['table'] = "Delete Slider";

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

        $organigram = Slider::find($req->id);
        if ($organigram->image != ""){
        echo '<div class="form-group">
                <div class="col-md-2"><strong>Image</strong></div>
                <div class="col-md-9">
                    <strong>:</strong> <img src="'.asset($pathp.'storage/slider/').'/'.$organigram->image.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-md-2 control-label"><strong>Category</strong></label>
                    <div class="col-md-9">
                        <strong>:</strong> '.$organigram->category.'
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}
