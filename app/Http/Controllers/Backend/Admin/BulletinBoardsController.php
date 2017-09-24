<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\BulletinBoard;
use App\Models\AuditrailLog;
use App\Models\Subscribe;
use App\Models\User;
use Sentinel;
use Input;
use Validator;
use Config;
use Mail;
use Image;
use URL;
use Event;
use File;
use App\Events\Backend\AdminAlertEvent;

class BulletinBoardsController extends Controller
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
        return view('backend.admin.bulletin-boards.index');
    }

    public function indexEditor(Request $req)
    {
        return view('backend.admin.bulletin-boards.editor');

    }

    public function create()
    {
        return view('backend.admin.bulletin-boarstatus_accountds.create');
    }

    public function datatables()
    {
         return datatables(BulletinBoard::all())
                ->addColumn('action', function ($bulletin_board) {
                    $quote = "'";
                    return $bulletin_board->publish_status == 'Yes' ?
                    ' 
                    <a href="javascript:show_bulletin_boards('.$bulletin_board->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$bulletin_board->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$bulletin_board->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>' :
                    '<a href="javascript:show_bulletin_boards('.$bulletin_board->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$bulletin_board->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$bulletin_board->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>'
                    ;
                })
                ->editColumn('img_url', function ($bulletin_board) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($bulletin_board->img_url != ""){
                    return "<img src='".asset($pathp.'storage/news/'.$bulletin_board->img_url)."' class='img-responsive' width='100px'>";  
                    }
                })
                ->editColumn('status', function ($bulletin_board) {
                    if ($bulletin_board->status != "news"){
                        return "Article";  
                    }else{
                        return "News";
                    }
                })
                ->editColumn('publish_status', function ($bulletin_board) {
                    if ($bulletin_board->publish_status != "Yes"){
                        return "Unpublish";  
                    }else{
                        return "Publish";
                    }
                })
                ->editColumn('content', function ($bulletin_board) {
                        return str_limit($bulletin_board->content, 25);  
                })
                ->make(true);
    }

    public function datatablesEditor()
    {
         return datatables(BulletinBoard::all())
                ->addColumn('action', function ($bulletin_board) {
                    $quote = "'";
                    return $bulletin_board->publish_status == 'Yes' ?
                    ' 
                    <a href="javascript:show_bulletin_boards('.$bulletin_board->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_unpublish('.$quote.$bulletin_board->id.$quote.')" class="btn btn-success btn-xs" title="Unpublish"><i class="fa fa-eye-slash fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$bulletin_board->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    ' :
                    '<a href="javascript:show_bulletin_boards('.$bulletin_board->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_publish('.$quote.$bulletin_board->id.$quote.')" class="btn btn-success btn-xs" title="Publish"><i class="fa fa-eye fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$bulletin_board->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    '
                    ;
                })
                ->editColumn('img_url', function ($bulletin_board) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($bulletin_board->img_url != ""){
                    return "<img src='".asset($pathp.'storage/news/'.$bulletin_board->img_url)."' class='img-responsive' width='100px'>";  
                    }
                })
                ->editColumn('publish_status', function ($bulletin_board) {
                    if ($bulletin_board->publish_status != "Yes"){
                        return "Unpublish";  
                    }else{
                        return "Publish";
                    }
                })
                ->editColumn('content', function ($bulletin_board) {
                        return str_limit($bulletin_board->content, 25);  
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $userData = BulletinBoard::find($request->id);   

        $response['id'] = $userData->id;
        echo json_encode($response);   
    }

    public function post_publish(Request $request){
        $user = Sentinel::getUser();
        $full_name = $user->first_name.' '.$user->last_name;
        
        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "BulletinBoard";

        $response = array();
        if($request->action == 'publish'){
            $response = array();
            $bulletin_board = BulletinBoard::find($request->id);                    
            $bulletin_board->publish_status = "Yes";
            $bulletin_board->publish_date = date('Y-m-d H:i:s');
            $bulletin_board->edit_by = $full_name;
            $bulletin_board->save();
            
            $audit->action = "Edit";
            $audit->before = $bulletin_board->publish_status.' | '.$bulletin_board->publish_date.' | '.$bulletin_board->edit_by;                    
            $audit->after = 'Yes | '.date('Y-m-d H:i:s').' | '.$full_name;

            $subscribe = array_column(Subscribe::where('status', 'confirmed')->get()->toArray(), 'email');
            $bulletin = BulletinBoard::find($request->id);

            $nes = [];
            foreach ($bulletin as $key => $value) {
                $nes[0] = $bulletin->id;
                $nes[1] = $bulletin->title;
                $nes[2] = $bulletin->img_url;
                $nes[3] = $bulletin->content;
            }

            foreach ($subscribe as $key => $value) {
                $find_data['email'] = $value;
                $find_data['id'] = $nes[0];
                $find_data['title'] = $nes[1];
                $find_data['img_url'] = $nes[2];
                $find_data['content'] = $nes[3];
                $find_data['full_name'] = "noname";
                
                Mail::send('email.new_post', $find_data, function($message) use($find_data) {
                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                            $message->to($find_data['email'], $find_data['full_name'])->subject('Recent Post');
                        });
            }

            $response['notification'] = "Success Publish Bulletin Board";
            $response['status'] = "success";
        
        }else{
            $response = array();            
            $bulletin_board = BulletinBoard::find($request->id);                    
            $bulletin_board->publish_status = "No";
            $bulletin_board->publish_date = "";
            $bulletin_board->edit_by = $full_name;
            $bulletin_board->save();
            
            $audit->action = "Edit";
            $audit->before = $bulletin_board->publish_status.' | '.$bulletin_board->publish_date.' | '.$bulletin_board->edit_by;                    
            $audit->after = 'No | | '.$full_name;

            $response['notification'] = "Success Unpublish Bulletin Board";
            $response['status'] = "success";
        }
        $audit->save();
        // $response['notification'] = "Gagal Bos";
        // $response['status'] = "success";
        
        echo json_encode($response);
    }

    public function post_buletin_board(Request $request){
        $url = URL::to('/');
        
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "BulletinBoard";

        if($request->action == 'get-data'){
            $bulletin_board = BulletinBoard::find($request->id);
            $response['title'] = $bulletin_board->title;
            $response['content'] = $bulletin_board->content;
            $response['author'] = $bulletin_board->author;
            $response['type'] = $bulletin_board->status;
            $response['publish_status'] = $bulletin_board->publish_status;            
            $response['img_url'] = BulletinBoard::getBulletinBoard($request->id,'image_path');
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'img_url'   => 'image|mimes:jpeg,jpg,png',
                'title'   => 'required',
                'content'   => 'required',
                'type'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                    if($request->action == 'create'){

                        $user = User::select('email','first_name')
                                    ->where('roles.slug', 'admin-editor')
                                    ->join('role_users','role_users.user_id','=','users.id')
                                    ->join('roles','roles.id','=','role_users.role_id')
                                    ->get();
                        // foreach ($user as $key => $value) {
                        //     $find_data['email'] = $value->email;
                        //     $find_data['first_name'] = $value->first_name;
                        //     Mail::send('email.editor_notification', $find_data, function($message) use($find_data) {
                        //                 $message->from("noreply@ponpesalihsancbr.id", 'AL Ihsan No-Reply');
                        //                 $message->to($find_data['email'], $find_data['first_name'])->subject('Postingan Baru');
                        //             });
                        // }

                        $bulletin_board = new BulletinBoard;
                        $bulletin_board->publish_status = "No";

                        $audit->action = "New";
                        $audit->content = $request->img_url.' | '.$request->title.' | '.$request->content.' | '.$request->type.' | '.$request->author;
                    }else{
                        // Event::fire(new AdminAlertEvent());

                        $bulletin_board = BulletinBoard::find($request->bulletin_board_id);

                        $audit->action = "Edit";
                        $audit->before = $bulletin_board->img_url.' | '.$bulletin_board->title.' | '.$bulletin_board->content.' | '.$bulletin_board->type.' | '.$bulletin_board->author;                    
                        $audit->after = $request->img_url.' | '.$request->title.' | '.$request->content.' | '.$request->type.' | '.$request->author;                    
                    }
                    $bulletin_board->title = $request->title;
                    $bulletin_board->slug = str_replace([" ","?"],["-", ""], $request->title);
                    $bulletin_board->content = $request->content;
                    $bulletin_board->status = $request->type;
                    if($request->type == "news"){
                        $bulletin_board->author = "";
                    }else{
                        $bulletin_board->author = $request->author;
                    }

                    $fileOverLoad = "";
                    if($request->hasFile('image')) {
                        if(filesize(Input::file('image'))<=1500000){
                            if($request->action == 'update'){                        
                                if($bulletin_board->img_url != ""){  
                                    $image_path = public_path().'/storage/news/'.$bulletin_board->img_url;
                                    if(file_exists($image_path))
                                        unlink($image_path);
                                }
                            }
                            
                            // createdirYmd('storage/news');
                            
                            $file = Input::file('image');            
                            $name = str_random(20). '-' .$file->getClientOriginalName();  
                            // $file->move(public_path().'/storage/news/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                            $path = public_path('storage/news/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                            resizeAndSaveImage($file, $path);
                            
                            $bulletin_board->img_url = date("Y")."/".date("m")."/".date("d")."/".$name;          
                        }else{
                            $fileOverLoad = "overload";
                        }
                    }



                    if($request->action == 'create' && empty($fileOverLoad)){
                        $response['url'] = $url;
                        $response['notification'] = 'Success Create Bulletin Board';
                        $response['status'] = 'success';

                        #-- save action
                        $bulletin_board->save();
                        $audit->save();
                    }else if($request->action == 'update' && empty($fileOverLoad)){
                        $response['notification'] = 'Success Update Bulletin Board';
                        $response['status'] = 'success';

                        #-- save action
                        $bulletin_board->save();
                        $audit->save();
                    }else{
                        $response['notification'] = 'Upload file size must be less than 1 Mb';
                        $response['status'] = 'failed';
                    }
              
            }
        }else{            
            $bulletin_board = BulletinBoard::find($request->bulletin_board_id);
            $audit->action = "Delete";
            $audit->content = $request->img_url.' | '.$request->title.' | '.$request->content.' | '.$request->type.' | '.$request->author;
            $audit->save();
                        
            if ($bulletin_board->delete()) {
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
            $find_data['table'] = "Delete Bulletin";

            // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
            //                     $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
            //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
            //                 });
        }

        echo json_encode($response);
    }

    public function post_buletin_board_editor(Request $request){
        $user = Sentinel::getUser();
        $full_name = $user->first_name.' '.$user->last_name;

        $response = array();
        
        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "BulletinBoard";

        if($request->action == 'get-data'){
            $bulletin_board = BulletinBoard::find($request->id);
            $response['title'] = $bulletin_board->title;
            $response['content'] = $bulletin_board->content;
            $response['author'] = $bulletin_board->author;
            $response['type'] = $bulletin_board->status;
            $response['publish_status'] = $bulletin_board->publish_status;            
            $response['img_url'] = BulletinBoard::getBulletinBoard($request->id,'image_path');
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'img_url'   => 'image|mimes:jpeg,jpg,png',
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
                        $find_data['table'] = "Create Buletin Editor";

                        Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });

                        $bulletin_board = new BulletinBoard;
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Buletin Editor";

                        // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                        //                     $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                        //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        //                 });

                        $bulletin_board = BulletinBoard::find($request->bulletin_board_id); 

                        $audit->action = "Edit";
                        $audit->before = $bulletin_board->img_url.' | '.$bulletin_board->title.' | '.$bulletin_board->content.' | '.$bulletin_board->type.' | '.$bulletin_board->author;                    
                        $audit->after = $request->img_url.' | '.$request->title.' | '.$request->content.' | '.$request->type.' | '.$request->author;                   
                    }
                    $bulletin_board->title = $request->title;
                    $bulletin_board->slug = str_replace([" ","?"],["-", ""], $request->title);
                    $bulletin_board->content = $request->content;
                    $bulletin_board->edit_by = $full_name;
                    
                    if($request->type == "news"){
                        $bulletin_board->author = "";
                    }else{
                        $bulletin_board->author = $request->author;
                    }

                    if($request->hasFile('image')) {
                        $fileOverLoad = "";
                        if(filesize(Input::file('image'))<=1500000){
                            if($request->action == 'update'){                        
                                if($bulletin_board->img_url != ""){  
                                    $image_path = public_path().'/storage/news/'.$bulletin_board->img_url;
                                    if(file_exists($image_path))
                                        unlink($image_path);
                                }
                            }
                            
                            // createdirYmd('storage/news');
                            $file = Input::file('image');            
                            $name = str_random(20). '-' .$file->getClientOriginalName();  
                            $bulletin_board->img_url = date("Y")."/".date("m")."/".date("d")."/".$name;          
                            // $file->move(public_path().'/storage/news/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                            $path = public_path('storage/news/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                            resizeAndSaveImage($file, $path);
                        }else{
                            $fileOverLoad = "overload";
                        }
                    }

                    if($request->action == 'create' && empty($fileOverLoad)){
                        $bulletin_board->save();
                        $audit->save();

                        $response['notification'] = 'Success Create Bulletin Board';
                        $response['status'] = 'success';
                    }else if ($request->action == 'update' && empty($fileOverLoad)){
                        $bulletin_board->save();
                        $audit->save();

                        $response['notification'] = 'Success Update Bulletin Board';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Upload file size must be less than 1 Mb';
                        $response['status'] = 'failed';
                    }
            }
        }else{            
            $bulletin_board = BulletinBoard::find($request->bulletin_board_id);
            if ($bulletin_board->delete()) {
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
            $find_data['table'] = "Delete Buletin Editor";

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

        $bulletin_board = BulletinBoard::find($req->id);
        if ($bulletin_board->img_url != ""){
        echo '
                        <div class="form-group">
                            <div class="col-lg-3">Gambar</div>
                            <div class="col-lg-9">
                                <img src="'.asset($pathp.'storage/news/'.$bulletin_board->img_url).'" class="img-responsive" >
                            </div>
                        </div>';
        }

        if($bulletin_board->status == "news")
        {
            $status = 'News';
        }else{
            $status = 'Article';
        }

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Type</label>
                    <div class="col-lg-9">
                        '.$status.'                        
                    </div>
                    <div class="clear"></div>
                </div>';

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Title</label>
                    <div class="col-lg-9">
                        '.$bulletin_board->title.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Content</label>
                    <div class="col-lg-9">
                        '.$bulletin_board->content.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        if($bulletin_board->status == "article"){
            echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Author</label>
                    <div class="col-lg-9">
                        '.$bulletin_board->author.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        }
        
        if($bulletin_board->publish_status == "Yes")
        {
            $publish_status = 'Publish';
        }else{
            $publish_status = 'Unpublish';
        }
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Publish Status</label>
                    <div class="col-lg-9">
                        '.$publish_status.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        
    }

    public function showEditor(Request $req)
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        $bulletin_board = BulletinBoard::find($req->id);
        if ($bulletin_board->img_url != ""){
        echo '
                        <div class="form-group">
                            <div class="col-lg-3">Gambar</div>
                            <div class="col-lg-9">
                                <img src="'.asset($pathp.'storage/news/'.$bulletin_board->img_url).'" class="img-responsive" >
                            </div>
                        </div>';
        }

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Title</label>
                    <div class="col-lg-9">
                        '.$bulletin_board->title.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Description</label>
                    <div class="col-lg-9">
                        '.$bulletin_board->description.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Contributor</label>
                    <div class="col-lg-9">
                        '.$bulletin_board->contributor.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Link Url</label>
                    <div class="col-lg-9">
                        '.$bulletin_board->link_url.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
                if($bulletin_board->publish_status == "on")
                {
                    $publish_status = 'On';
                }else{
                    $publish_status = 'Off';
                }
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Publish Status</label>
                    <div class="col-lg-9">
                        '.$publish_status.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        
    }
}
