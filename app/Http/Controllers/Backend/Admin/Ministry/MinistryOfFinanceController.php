<?php

namespace App\Http\Controllers\Backend\Admin\Ministry;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\FinanceManagement;
use App\Models\AuditrailLog;
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

class MinistryOfFinanceController extends Controller
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

    public function indexOfFinance(Request $req)
    {
        return view('backend.admin.ministry.finance.index');
    }

    public function createOfFinance()
    {
        return view('backend.admin.ministry.finance.create');
    }

    public function datatableOfFinance()
    {
         return datatables(FinanceManagement::all())
                ->addColumn('action', function ($ministryOfFinance) {
                    $quote = "'";
                    return 
                        '<a href="javascript:show_finance('.$ministryOfFinance->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                        <a onclick="javascript:show_form_update('.$quote.$ministryOfFinance->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        <a onclick="javascript:show_form_delete('.$quote.$ministryOfFinance->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                })
                ->editColumn('value', function ($ministryOfFinance) {
                        return idr_format($ministryOfFinance->value);  
                })
                ->editColumn('date', function ($ministryOfFinance) {
                        return eform_date($ministryOfFinance->date);  
                })
                ->editColumn('description', function ($ministryOfFinance) {
                        return str_limit($ministryOfFinance->description, 25);  
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $userData = FinanceManagement::find($request->id);   

        $response['id'] = $userData->id;
        echo json_encode($response);   
    }

    public function post_finance(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "finance_management";

        if($request->action == 'get-data'){
            $ministryOfFinance = FinanceManagement::find($request->id);
            $response['type'] = $ministryOfFinance->type;
            $response['value'] = $ministryOfFinance->value;
            $response['date'] = $ministryOfFinance->date;
            $response['description'] = $ministryOfFinance->description;
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'type'          => 'required',
                'value'          => 'required',
                'date'          => 'required',
                'description'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                if($request->action == 'create'){

                    $ministryOfFinance = new FinanceManagement;

                    $audit->action = "New";
                    $audit->content = $request->type.' | '.$request->value.' | '.$request->date.' | '.$request->description;
                }else{
                    // Event::fire(new AdminAlertEvent());

                    $ministryOfFinance = FinanceManagement::find($request->finance_id);

                    $audit->action = "Edit";
                    $audit->before = $ministryOfFinance->type.' | '.$ministryOfFinance->value.' | '.$ministryOfFinance->date.' | '.$ministryOfFinance->description;                    
                    $audit->after = $request->type.' | '.$request->value.' | '.$request->date.' | '.$request->description;
                }

                $ministryOfFinance->type        = $request->type;
                $ministryOfFinance->value       = $request->value;
                $ministryOfFinance->date        = $request->date;
                $ministryOfFinance->description = $request->description;

                if($request->action == 'create'){
                    $response['notification'] = 'Success Create Data';
                    $response['status'] = 'success';

                    #-- save action
                    $ministryOfFinance->save();
                    $audit->save();
                }else if($request->action == 'update'){
                    $response['notification'] = 'Success Update Data';
                    $response['status'] = 'success';

                    #-- save action
                    $ministryOfFinance->save();
                    $audit->save();
                }
              
            }
        }else{            
            $ministryOfFinance = FinanceManagement::find($request->finance_id);
            $audit->action = "Delete";
            $audit->content = $request->type.' | '.$request->value.' | '.$request->date.' | '.$request->description;
            $audit->save();
                        
            if ($ministryOfFinance->delete()) {
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

        $ministryOfFinance = FinanceManagement::find($req->id);

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Type</label>
                    <div class="col-lg-9">
                        : '.$ministryOfFinance->type.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Date</label>
                    <div class="col-lg-9">
                        : '.eform_date($ministryOfFinance->date).'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Value</label>
                    <div class="col-lg-9">
                        : '.idr_format($ministryOfFinance->value).'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    
        echo '<div class="form-group">
                <label class="col-lg-3 control-label">Description</label>
                <div class="col-lg-9">
                    : '.$ministryOfFinance->description.'                        
                </div>
                <div class="clear"></div>
            </div>';
    }
}
