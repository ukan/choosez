<?php

namespace App\Http\Controllers\Backend\Admin\DownloadCategory;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\DownloadCategory;
use App\Models\AuditrailLog;

use Input;
use Validator;
use Config;
use Sentinel;
use Mail;
use DB;

class DownloadCategoryController extends Controller
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
        return view('backend.admin.download-category-management.index');
    }

    public function datatables()
    {
         return datatables(DownloadCategory::all())
                ->addColumn('action', function ($downloadCategory) {
                    $quote = "'";
                    return
                    ' 
                    <a onclick="javascript:show_form_update('.$quote.$downloadCategory->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$downloadCategory->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>'
                    ;
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $downloadCategoryData = DownloadCategory::find($request->id);   

        $response['id'] = $downloadCategoryData->id;
        
        echo json_encode($response);   
    }

    public function post_download_category(Request $request){
        $response = array();
        $audit = new AuditrailLog;

        if($request->action == 'get-data'){
            $downloadCategory = DownloadCategory::find($request->id);
            
            $response['name'] = $downloadCategory->name;            
        }else if($request->action != 'delete'){

            $param = $request->all();
            
            $rules = [ 'name'   => 'required',];

            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                DB::beginTransaction();
                try{
                    $audit->email = Sentinel::getUser()->email;
                    
                    if($request->action == 'create'){
                        $downloadCategory = new DownloadCategory;
                        $audit->action = "New";
                        $audit->content = $request->name;
                    }else{
                        $downloadCategory = DownloadCategory::find($request->download_category_id);                    
                        $audit->action = "Edit";
                        $audit->before = $downloadCategory->name;
                        $audit->after = $request->name;
                    }

                    $downloadCategory->name = $request->name;

                    $audit->table_name = "DownloadCategory";
                    $audit->save();
              
                    if($request->action == 'create'){
                        $downloadCategory->save();
                        
                        $response['notification'] = 'Success Create Category Data';
                        $response['status'] = 'success';
                    }else{
                        $downloadCategory->save();

                        $response['notification'] = 'Success Update Category Data';
                        $response['status'] = 'success';
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
            $downloadCategory = DownloadCategory::find($request->download_category_id);

            $audit->email = Sentinel::getUser()->email;
            $audit->action = "Delete";
            $audit->table_name = "DownloadCategory";
            $audit->content = $downloadCategory->name;
            $audit->save();

            if ($downloadCategory->delete()) {
                $response['notification'] = 'Delete Data Success';
                $response['status'] = 'success';
            } else {
                $response['notification'] = 'Delete Data Failed';
                $response['status'] = 'failed';
            }
        }

        echo json_encode($response);
    }
}