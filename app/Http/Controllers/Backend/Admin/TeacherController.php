<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Teacher;
use App\Models\AuditrailLog;
use Sentinel;
use Input;
use Validator;
use Config;

class TeacherController extends Controller
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
        return view('backend.admin.teacher-management.index');
    }

    public function datatables()
    {
         return datatables(Teacher::all())
                ->addColumn('action', function ($teacher) {
                    $quote = "'";
                    return
                    ' 
                    <a href="javascript:show_teacher('.$teacher->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$teacher->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$teacher->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>'
                    ;
                })
                ->editColumn('photo', function ($teacher) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($teacher->photo != ""){
                        return "<img class='center-align' src='".asset($pathp.'storage/avatars/').'/'.$teacher->photo."' class='img-responsive' width='100px'>";  
                    }
                })
                ->editColumn('position', function ($teacher) {
                    $result = "";

                    if ($teacher->position == "leadership"){
                        $result = "Pimpinan";
                    }else if($teacher->position == "hod_ac"){
                        $result = "Kabag Akademik";
                    }else if($teacher->position == "hod_ks"){
                        $result = "Kabag Kesantrian";
                    }else if($teacher->position == "treasurer"){
                        $result = "bendahara";
                    }else{
                        $result = "Dewan Guru";
                    }

                    return $result;
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $userData = Teacher::find($request->id);   

        $response['id'] = $userData->id;
        echo json_encode($response);   
    }

    public function post_teacher(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Teacher";

        if($request->action == 'get-data'){
            $teacher = Teacher::find($request->id);
            $response['name'] = $teacher->name;
            $response['email'] = $teacher->email;
            $response['phone'] = $teacher->phone;
            $response['position'] = $teacher->position;
            $response['organization'] = $teacher->organization;            
            $response['postal_code'] = $teacher->postal_code;            
            $response['facebook'] = $teacher->facebook;            
            $response['instagram'] = $teacher->instagram;            
            $response['linkedin'] = $teacher->linkedin;            
            $response['caption'] = $teacher->caption;            
            $response['photo'] = Teacher::getTeacher($request->id,'image_path');
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'image'   => 'image|mimes:jpeg,jpg,png',
                'name'   => 'required',
                'email'   => 'required|email',
                'phone'   => 'required|numeric',
                'address'   => 'required',
                'organization'   => 'required',
                'postal_code'   => 'required|numeric',
                // 'instagram'   => 'url',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                    if($request->action == 'create'){
                        $teacher = new Teacher;

                        $audit->action = "New";
                        $audit->content = $request->image.' | '.$request->name.' | '.$request->email.' | '.$request->phone.' | '.$request->address.' | '.$request->organization.' | '.$request->postal_code;
                    }else{
                        $teacher = Teacher::find($request->teacher_id);                    

                        $audit->action = "Edit";
                        $audit->before = $teacher->photo.' | '.$teacher->name.' | '.$teacher->email.' | '.$teacher->phone.' | '.$teacher->address.' | '.$teacher->organization.' | '.$teacher->postal_code;
                        $audit->after = $request->image.' | '.$request->name.' | '.$request->email.' | '.$request->phone.' | '.$request->address.' | '.$request->organization.' | '.$request->postal_code;
                    }
                    $teacher->name = $request->name;
                    $teacher->email = $request->email;
                    $teacher->phone = $request->phone;
                    $teacher->address = $request->address;
                    $teacher->position = $request->position;
                    $teacher->organization = $request->organization;
                    $teacher->postal_code = $request->postal_code;
                    $teacher->facebook = $request->facebook;
                    $teacher->instagram = $request->instagram;
                    $teacher->linkedin = $request->linkedin;
                    $teacher->quote = $request->caption;

                    if($request->hasFile('image')) {
                        if($request->action == 'update'){                        
                            if($teacher->photo != ""){  
                            $image_path = public_path().'/storage/avatars/'.$teacher->photo;
                            unlink($image_path);
                            }
                        }
                        createdirYmd('storage/avatars');
                        $file = Input::file('image');            
                        $name = str_random(20). '-' .$file->getClientOriginalName();  
                        $teacher->photo = date("Y")."/".date("m")."/".date("d")."/".$name;          
                        $file->move(public_path().'/storage/avatars/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                    }
              
                    $teacher->save();
                    $audit->save();

                    if($request->action == 'create'){
                        $response['notification'] = 'Success Create Teacher Data';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Success Update Teacher Data';
                        $response['status'] = 'success';
                    }
            }
        }else{            
            $teacher = Teacher::find($request->teacher_id);

            $audit->action = "Delete";
            $audit->content = $teacher->image.' | '.$teacher->name.' | '.$teacher->email.' | '.$teacher->phone.' | '.$teacher->address.' | '.$teacher->organization.' | '.$teacher->postal_code;
            $audit->save();

            if ($teacher->delete()) {
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

        $teacher = Teacher::find($req->id);
        if ($teacher->photo != ""){
        echo '<div class="form-group">
                <div class="col-lg-3">Photo</div>
                <div class="col-lg-9">
                    <img src="'.asset($pathp.'storage/avatars/').'/'.$teacher->photo.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Name</label>
                    <div class="col-lg-9">
                        '.$teacher->name.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Email</label>
                    <div class="col-lg-9">
                        '.$teacher->email.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Phone</label>
                    <div class="col-lg-9">
                        '.$teacher->phone.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
                $result = "";

                if ($teacher->position == "leadership"){
                    $result = "Pimpinan";
                }else if($teacher->position == "hod_ac"){
                    $result = "Kabag Akademik";
                }else if($teacher->position == "hod_ks"){
                    $result = "Kabag Kesantrian";
                }else if($teacher->position == "treasurer"){
                    $result = "bendahara";
                }else{
                    $result = "Dewan Guru";
                }
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">position</label>
                    <div class="col-lg-9">
                        '.$result.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Province</label>
                    <div class="col-lg-9">
                        '.$teacher->province.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">District</label>
                    <div class="col-lg-9">
                        '.$teacher->district.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Region</label>
                    <div class="col-lg-9">
                        '.$teacher->region.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Address</label>
                    <div class="col-lg-9">
                        '.$teacher->address.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Postal Code</label>
                    <div class="col-lg-9">
                        '.$teacher->postal_code.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Caption</label>
                    <div class="col-lg-9">
                        '.$teacher->quote.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}
