<?php

namespace App\Http\Controllers\Frontend\Member;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Suggestion;
use App\Models\User;
use App\Models\AuditrailLog;
use Sentinel;
use Input;
use Validator;
use Mail;

class SuggestionController extends Controller
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
        return view('frontend.member.suggestion.index');
    }

    public function datatables()
    {
        $eloq = Suggestion::selectRaw('suggestions.id,
                                        suggestions.subject,
                                        suggestions.user_id,
                                        suggestions.content,
                                        suggestions.updated_at,
                                        suggestions.read_by,
                                        users.username,
                                        suggestions.status')
                    ->leftJoin('users','users.id','=','suggestions.read_by')
                    ->where('user_id', user_info('id'))
                    ->orderBy('suggestions.id', 'desc')->get();

         return datatables($eloq)
                ->addColumn('action', function ($suggestion) {
                    $quote = "'";
                    return
                    ($suggestion->status == "Read") ?
                        ' 
                        <a href="javascript:show_suggestion('.$quote.$suggestion->id.$quote.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                        <a class="btn btn-warning btn-xs" title="Ubah" disabled><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        <a class="btn btn-danger btn-xs actDelete" title="Hapus" disabled><i class="fa fa-trash-o fa-fw"></i></a>'
                    :
                    ' 
                    <a href="javascript:show_suggestion('.$quote.$suggestion->id.$quote.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$suggestion->id.$quote.')" class="btn btn-warning btn-xs" title="Ubah"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$suggestion->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Hapus"><i class="fa fa-trash-o fa-fw"></i></a>'
                    ;
                })
                ->editColumn('content', function($suggestion){
                    return str_limit($suggestion->content,70);
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $suggestionData = Book::find($request->id);   

        $response['id'] = $suggestionData->id;
        echo json_encode($response);   
    }

    public function post_suggestion(Request $request){
        $response = array();

        $audit = new AuditrailLog;
        $audit->email = Sentinel::getUser()->email;
        $audit->table_name = "Suggestion";

        if($request->action == 'get-data'){
            $suggestion = Suggestion::find($request->id);
            $response['subject'] = $suggestion->subject;
            $response['content'] = $suggestion->content;                        
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'subject'   => 'required',
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
                        $find_data['table'] = "Create Siggestion";

                        /*Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });*/

                        $suggestion = new Suggestion;
                        $suggestion->status = "Not Yet Checked";
                        $suggestion->user_id = user_info('id');

                        $audit->action = "New";
                        $audit->content = $request->subject.' | '.$request->content;
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Suggestion";

                        /*Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                                        });*/

                        $suggestion = Suggestion::find($request->suggestion_id);

                        $audit->action = "Edit";
                        $audit->before = $suggestion->subject.' | '.$suggestion->content;                    
                        $audit->after = $request->subject.' | '.$request->content;                    
                    }
                    $suggestion->subject = $request->subject;
                    $suggestion->content = $request->content;
              
                    $suggestion->save();
                    $audit->save();

                    if($request->action == 'create'){
                        $response['notification'] = 'Create Data Successfully';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Edit Data Successfully';
                        $response['status'] = 'success';
                    }
            }
        }else{            
            $suggestion = Suggestion::find($request->suggestion_id);

            $audit->action = "Delete";
            $audit->content = $suggestion->subject.' | '.$suggestion->content;
            $audit->save();

            if ($suggestion->delete()) {
                        $response['notification'] = 'Delete Data Successfully';
                        $response['status'] = 'success';
            } else {
                        $response['notification'] = 'Delete Data Failed';
                        $response['status'] = 'failed';
            }

            $data = Sentinel::getUser()->first_name;
            $find_data['email'] = "x";
            $find_data['id'] = "cek";
            $find_data['full_name'] = $data;
            $find_data['table'] = "Delete Suggestion";

            /*Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                                $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                                $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                            });*/
        }

        echo json_encode($response);
    }

    public function show(Request $req)
    {
        $suggestion = Suggestion::selectRaw('suggestions.id,
                                        suggestions.subject,
                                        suggestions.user_id,
                                        suggestions.content,
                                        suggestions.updated_at,
                                        suggestions.status')
                    ->where('user_id', user_info('id'))
                    ->where('id', $req->id)
                    ->get()->first();

        echo '<div class="form-group">
                    <label class="col-lg-2 control-label">Subject</label>
                    <div class="col-lg-9">
                        : '.$suggestion->subject.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-2 control-label">Content</label>
                    <div style="text-align:justify" class="col-lg-9">
                        : '.$suggestion->content.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}