<?php

namespace App\Http\Controllers\Backend\Admin\Download;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Download;
use App\Models\DownloadCategory;
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
        $category = DownloadCategory::dropdown();
            
        return view('backend.admin.download-management.index')->with('categories', $category);
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
                ->editColumn('category', function ($download) {
                    if(!empty($download->category)){
                        $categories = DownloadCategory::whereIn('id', json_decode($download->category,TRUE))->get();  

                        $categoryLists = [];
                        foreach ($categories as $keyCategory => $category) {
                            array_push($categoryLists, "<span style='color:".random_color($category->id, $category->name)."'><b>".$category->name."</b>");
                        }

                        $category = implode(', ', $categoryLists);
                    }else{
                        $category = "<span color='grey'><em><b>Uncategorized</b></em></span>";
                    }

                    return $category;
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

        if($request->action == 'get-data'){
            $download = Download::find($request->id);
            $response['title'] = $download->title;
            $response['description'] = $download->description;            
            $response['image_path'] = Download::getDownload($request->id,'image_path');
            $response['link'] = $download->link;            
            $response['category'] = json_decode($download->category,TRUE);            
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'image'         => 'image|mimes:jpeg,jpg,png',
                'title'         => 'required',
                'link'          => 'required',
                'description'   => 'required',
                'category'    => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                DB::beginTransaction();
                try{
                    $audit->email = Sentinel::getUser()->email;
                    
                    if($request->action == 'create'){
                        $download = new Download;
                        $audit->action = "New";
                        $audit->content = $request->image.' | '.$request->title.' | '.$request->description.' | '.$request->link.' | '.json_encode($request->category);
                    }else{
                        $download = Download::find($request->download_id);                    
                        $audit->action = "Edit";
                        $audit->before = $download->image_path.' | '.$download->title.' | '.$download->description.' | '.$download->link.' | '.$download->category;
                        $audit->after = $request->image.' | '.$request->title.' | '.$request->description.' | '.$request->link.' | '.json_encode($request->category);
                    }
                    $download->title        = $request->title;
                    $download->description  = $request->description;
                    $download->link         = $request->link;
                    $download->category     = json_encode($request->category);

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
                    DB::commit();
                }
                catch (\Exception $e)
                {
                    DB::rollback();
                    throw new \Exception($e->getMessage());
                }
            }
        }else{            
            $download = Download::find($request->download_id);

            $audit->email       = Sentinel::getUser()->email;
            $audit->action      = "Delete";
            $audit->table_name  = "Download";
            $audit->content     = $download->image_path.' | '.$download->title.' | '.$download->description.' | '.$download->link.' | '.$download->category;
            $audit->save();

            if ($download->delete()) {
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
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Description</label>
                    <div class="col-lg-9">
                        '.$download->description.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Link</label>
                    <div class="col-lg-9">
                        '.$download->link.'                        
                    </div>
                    <div class="clear"></div>
                </div>';

        if(!empty($download->category)){
            $categories = DownloadCategory::whereIn('id', json_decode($download->category,TRUE))->get();  

            $categoryLists = [];
            foreach ($categories as $keyCategory => $category) {
                array_push($categoryLists, "<span style='color:".random_color($category->id, $category->name)."'><b>".$category->name."</b>");
            }

            $category = implode(', ', $categoryLists);
        }else{
            $category = "<span color='grey'><em><b>Uncategorized</b></em></span>";
        }
        
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Category</label>
                    <div class="col-lg-9">
                        '.$category.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}