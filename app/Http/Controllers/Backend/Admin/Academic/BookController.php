<?php

namespace App\Http\Controllers\Backend\Admin\Academic;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\Book;
use App\Models\AuditrailLog;
use Input;
use Validator;
use Config;
use Sentinel;
use Mail;

class BookController extends Controller
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
        return view('backend.admin.book-management.index');
    }

    public function datatables()
    {
         return datatables(Book::all())
                ->addColumn('action', function ($book) {
                    $quote = "'";
                    return
                    ' 
                    <a href="javascript:show_book('.$book->id.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-search fa-fw"></i></a>
                    <a onclick="javascript:show_form_update('.$quote.$book->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a onclick="javascript:show_form_delete('.$quote.$book->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>'
                    ;
                })
                ->editColumn('image', function ($book) {
                    $pathp = "";

                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                    if ($book->image != ""){
                    return "<img class='center-align' src='".asset($pathp.'storage/books/').'/'.$book->image."' class='img-responsive' width='100px'>";  
                    }
                })
                ->make(true);
    }

    public function get_data(Request $request){
        
        $response = array();
        $bookData = Book::find($request->id);   

        $response['id'] = $bookData->id;
        echo json_encode($response);   
    }

    public function post_book(Request $request){
        $response = array();
        $audit = new AuditrailLog;
        
        if($request->action == 'get-data'){
            $book = Book::find($request->id);
            $response['name'] = $book->nama_kitab;
            $response['author'] = $book->pengarang;            
            $response['description'] = $book->description;            
            $response['image'] = Book::getBook($request->id,'image_path');
        }else if($request->action != 'delete'){

            $param = $request->all();
            $rules = array(
                'image'   => 'image|mimes:jpeg,jpg,png',
                'name'   => 'required',
                'author'   => 'required',
                'description'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            if($validate->fails()) {
                $this->validate($request,$rules);
            } else {
                    $audit->email = Sentinel::getUser()->email;
                    
                    if($request->action == 'create'){
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Create book";

                        // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                        //                     $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                        //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        //                 });

                        $book = new Book;
                        $audit->action = "New";
                        $audit->content = $request->image.' | '.$request->name.' | '.$request->author.' | '.$request->description;
                    }else{
                        $data = Sentinel::getUser()->first_name;
                        $find_data['email'] = "x";
                        $find_data['id'] = "cek";
                        $find_data['full_name'] = $data;
                        $find_data['table'] = "Update Book";

                        // Mail::send('email.update_admin', $find_data, function($message) use($find_data) {
                        //                     $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                        //                     $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        //                 });

                        $book = Book::find($request->book_id);                    
                        $audit->action = "Edit";
                        $audit->before = $book->image.' | '.$book->nama_kitab.' | '.$book->pengarang.' | '.$book->description;
                        $audit->after = $request->image.' | '.$request->name.' | '.$request->author.' | '.$request->description;
                    }
                    $book->nama_kitab = $request->name;
                    $book->pengarang = $request->author;
                    $book->description = $request->description;

                    $audit->table_name = "Kajian";
                    $audit->save();
                    
                    $fileOverLoad = "";
                    if($request->hasFile('image')) {
                        if(filesize(Input::file('image'))<=1500000){
                            if($request->action == 'update'){                        
                                if($book->image != ""){  
                                    $image_path = public_path().'/storage/books/'.$book->image;
                                    if(file_exists($image_path))
                                        unlink($image_path);
                                }
                            }
                            $file = Input::file('image');            
                            $name = str_random(20). '-' .$file->getClientOriginalName();  
                            $book->image = date("Y")."/".date("m")."/".date("d")."/".$name;          
                            // $file->move(public_path().'/storage/books/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                            // createdirYmd('storage/books');
                            $path = public_path('/storage/books/'.date("Y")."/".date("m")."/".date("d")."/". $name);
                            resizeAndSaveImage($file, $path);
                        }else{
                            $overload = "overload";
                        }
                    }
              
                    if($request->action == 'create' && empty($fileOverLoad)){
                        $book->save();
                        
                        $response['notification'] = 'Success Create Book Data';
                        $response['status'] = 'success';
                    }else if($request->action == 'update' && empty($fileOverLoad){
                        $book->save();

                        $response['notification'] = 'Success Update Book Data';
                        $response['status'] = 'success';
                    }else{
                        $response['notification'] = 'Upload file size must be less than 1 Mb';
                        $response['status'] = 'failed';
                    }
            }
        }else{            
            $book = Book::find($request->book_id);

            $audit->email = Sentinel::getUser()->email;
            $audit->action = "Delete";
            $audit->table_name = "Kajian";
            $audit->content = $book->image.' | '.$book->nama_kitab.' | '.$book->pengarang.' | '.$book->description;
            $audit->save();

            if ($book->delete()) {
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
            $find_data['table'] = "Delete book";

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

        $book = Book::find($req->id);
        if ($book->image != ""){
        echo '<div class="form-group">
                <div class="col-lg-3">Image</div>
                <div class="col-lg-9">
                    <img src="'.asset($pathp.'/storage/books/').'/'.$book->image.'" class="img-responsive" >
                </div>
            </div>';
        }

        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Name</label>
                    <div class="col-lg-9">
                        '.$book->nama_kitab.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Author</label>
                    <div class="col-lg-9">
                        '.$book->pengarang.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
        echo '<div class="form-group">
                    <label class="col-lg-3 control-label">Description</label>
                    <div class="col-lg-9">
                        '.$book->description.'                        
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}