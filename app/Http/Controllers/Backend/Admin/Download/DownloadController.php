<?php

namespace App\Http\Controllers\Backend\Admin\Download;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Download;
use App\Models\AuditrailLog;

use Input;
use Validator;
use Config;
use Sentinel;
use Mail;
use DB;

class DownloadController extends Controller
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
        return view('backend.admin.download-management.index');
    }

    public function datatables()
    {
         return datatables(Download::all())
                ->addColumn('action', function ($download) {
                    $quote = "'";
                    return
                    ' 
                    <a href="javascript:show_download('.$download->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$download->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$download->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>'
                    ;
                })
                ->editColumn('image', function ($download) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($download->image_path != ""){
                    
                    return "<img class='center-align' src='".asset($pathp.'storage/downloads/').'/'.$download->image_path."' class='img-responsive' width='100px'>";  
                    }
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $downloadData = Download::find($request->id);   

        $response['id'] = $downloadData->id;
        echo json_encode($response);   
    }

    public function post_download(Request $request){
        $response = array();
        $audit = new AuditrailLog;
        DB::beginTransaction();
        try{

            if($request->action == 'get-data'){
                $download = Download::find($request->id);
                $response['title'] = $download->title;
                $response['description'] = $download->description;            
                $response['image_path'] = Download::getDownload($request->id,'image_path');
                $response['link'] = $download->link;            
            }else if($request->action != 'delete'){

                $param = $request->all();
                $rules = array(
                    'image'         => 'image|mimes:jpeg,jpg,png',
                    'title'         => 'required',
                    'link'          => 'required',
                    // 'description'   => 'required',
                );
                $validate = Validator::make($param,$rules);
                if($validate->fails()) {
                    $this->validate($request,$rules);
                } else {
                        $audit->email = Sentinel::getUser()->email;
                        
                        if($request->action == 'create'){
                            $download = new Download;
                            $audit->action = "New";
                            $audit->content = $request->image.' | '.$request->title.' | '.$request->description.' | '.$request->link;
                        }else{
                            $download = Download::find($request->download_id);                    
                            $audit->action = "Edit";
                            $audit->before = $download->image_path.' | '.$download->title.' | '.$download->description.' | '.$download->link;
                            $audit->after = $request->image.' | '.$request->title.' | '.$request->description.' | '.$request->link;
                        }
                        $download->title = $request->title;
                        $download->description = $request->description;
                        $download->link = $request->link;

                        $audit->table_name = "Download";
                        $audit->save();
                        
                        $fileOverLoad = "";
                        if($request->hasFile('image')) {
                            if(filesize(Input::file('image'))<=1500000){
                                if($request->action == 'update'){                        
                                    if($download->image_path != ""){  
                                        $image_path = public_path().'/storage/downloads/'.$download->image_path;
                                        if(file_exists($image_path))
                                            unlink($image_path);
                                    }
                                }
                                $file = Input::file('image');            
                                $name = str_random(20). '-' .$file->getClientOriginalName();  
                                $download->image_path = date("Y")."/".date("m")."/".date("d")."/".$name;          
                                
                                $path = public_path('/storage/downloads/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                                resizeAndSaveImage($file, $path);
                            }else{
                                $overload = "overload";
                            }
                        }
                  
                        if($request->action == 'create' && empty($fileOverLoad)){
                            $download->save();
                            
                            $response['notification'] = 'Success Create Download Data';
                            $response['status'] = 'success';
                        }else if($request->action == 'update' && empty($fileOverLoad)){
                            $download->save();

                            $response['notification'] = 'Success Update Download Data';
                            $response['status'] = 'success';
                        }else{
                            $response['notification'] = 'Upload file size must be less than 1 Mb';
                            $response['status'] = 'failed';
                        }
                }
            }else{            
                $download = Download::find($request->download_id);

                $audit->email = Sentinel::getUser()->email;
                $audit->action = "Delete";
                $audit->table_name = "Download";
                $audit->content = $download->image_path.' | '.$download->title.' | '.$download->description.' | '.$download->link;
                $audit->save();

                if ($download->delete()) {
                            $response['notification'] = 'Delete Data Success';
                            $response['status'] = 'success';
                } else {
                            $response['notification'] = 'Delete Data Failed';
                            $response['status'] = 'failed';
                }
            }
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }

        echo json_encode($response);
    }

    public function show(Request $req)
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        $download = Download::find($req->id);
        if ($download->image_path != ""){
        echo '<div class="form-group">
                <div class="col-lg-3">Image</div>
                <div class="col-lg-9">
                    <img src="'.asset($pathp.'/storage/downloads/').'/'.$download->image_path.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Title</label>
                    <div class="col-lg-9">
                        '.$download->title.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        // echo '<div class="form-group">
        //             <label class="col-lg-3 control-label">Author</label>
        //             <div class="col-lg-9">
        //                 '.$download->description.'                        
        //             </div>
        //             <div class="clear"></div>
        //         </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Link</label>
                    <div class="col-lg-9">
                        '.$download->link.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}