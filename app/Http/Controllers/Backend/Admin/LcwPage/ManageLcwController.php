<?php

namespace App\Http\Controllers\Backend\Admin\LcwPage;

//use App\Models\Menu;
use App\Http\Controllers\Backend\Admin\BaseController;
use Illuminate\Http\Request;
use DB;
use Validator;

use App\Models\ManageLcw;
use App\Models\HomeMenu;
use Input;

class ManageLcwController extends BaseController
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'sections' => ['' => 'Select your option', '1' => 1, '3' => 3, '5' => 5, '6' => 6, '7' => 7, '10' => 10, '11' => 11, '13' => 13, '14' => 14, '16' => 16, '17' => 17, '18' => 18, '20' => 20]
        ];

        $items = DB::table('home_menus')
            ->select('index')
            ->orderBy('index','asc')
            ->get();

        /*$max = DB::table('home_menus')
                 ->max('index');*/
        $newTab = DB::table('manage_lcw')
            ->select('background')
            ->get();
        foreach ($newTab as $key => $value) {
            $back = $value->background;
        }
        // dd($back);
        return view('backend.admin.manage-lcw.form', $data)->with('items', $items)->with('background', $back);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @input  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $response = array();
    
        if($req->method != 'delete'){
            $param = $req->all();
            $rules = array(
                'title'   => 'required',
                'content'   => 'required',
                'display_link_to_name'   => 'required',
                'link_to_href'   => 'required',
                'link_videos'   => 'required',
                'content_foo'   => 'required',
                'sub_content_foo'   => 'required',
                'blue_text_foo'   => 'required',
            );
            $validate = Validator::make($param,$rules);
            $datasLcw = ManageLcw::find($req->id);                    
            $title = "";
            $content = "";
            $link_to_name = "";
            $display_link_to_name = "";
            $link_to_href = "";
            $link_videos = "";
            $newTab = "";
            $contentFoo = "";
            $subContentFoo = "";
            $blueTextFoo = "";

            $other = array();
            $counter=0;

            foreach($req->all() as $name => $value){
                $other[$counter] = $value;
                $counter++;
            }
            
            foreach($req->all() as $name => $value){
                if($name == "title"){
                    $title = $value;    
                }else if($name == "content"){
                    $content = $value;    
                }else if($name == "link_to_name"){
                    $link_to_name = $value;    
                }else if($name == "display_link_to_name"){
                    $display_link_to_name = $value;    
                }else if($name == "link_to_href"){
                    $link_to_href = $value;    
                }else if($name == "link_videos"){
                    $link_videos = $value;    
                }else if($name == "newTab"){
                    $newTab = $value;
                }else if($name == "content_foo"){
                    $contentFoo = $value;
                }else if($name == "sub_content_foo"){
                    $subContentFoo = $value;
                }else if($name == "blue_text_foo"){
                    $blueTextFoo = $value;
                }else if ($name == "_token"){

                }else if ($name == "id"){

                }else{
                    // $menus .= $name."=".$value."|";
                }            
            }

            if($validate->fails()) {
                $this->validate($req,$rules);
            } else {
                // dd();
                $datasLcw->title = $title;
                $datasLcw->content = $content;
                $datasLcw->link_to_name = $link_to_name;
                $datasLcw->display_link_to_name = $display_link_to_name;
                $datasLcw->link_to_href = $link_to_href;
                $datasLcw->link_videos = $link_videos;
                $datasLcw->new_tab = $newTab;
                $datasLcw->content_foo = $contentFoo;
                $datasLcw->sub_content_foo = $subContentFoo;
                $datasLcw->blue_text_foo = $blueTextFoo;
                if( $req->hasFile('background') ){
                    if($datasLcw->background != ""){  
                        $image_path = public_path().'/storage/background/'.$datasLcw->background;
                        unlink($image_path);
                    }
                    createdirYmd('storage/background');
                    $file = Input::file('background');            
                    $name = str_random(20). '-' .$file->getClientOriginalName();            
                    $datasLcw->background = date("Y")."/".date("m")."/".date("d")."/".$name;          
                    $file->move(public_path().'/storage/background/'.date("Y")."/".date("m")."/".date("d")."/", $name);
                    
                }else{                            
                    $datasLcw->background = $datasLcw->background;                        
                }
                $datasLcw->save();
                
                $response['notification'] = "Success Edit Data";
                $response['status'] = "success";
            }
        }else{            
            /*$response = array();
            $datasLcw = Contact::find($req->id);
            if ($datasLcw->delete()) {
                $response['notification'] = 'Delete Data Success';
                $response['status'] = "success";
            } else {
                $response['notification'] = 'Delete Data Failed';
                $response['status'] = 'failed';
            }*/
        }

        echo json_encode($response);
    }

    /*function datatables optin*/
    public function datatables(Request $request){
        $eloq = HomeMenu::select('id','index','name','display_name','href')
                ->orderBy('index', 'desc')
                ->get();
        
    return datatables($eloq)->addColumn('action', function($menu) {
                        $action_edit = "javascript:show_form_edit_menu('".$menu->id."')";
                        $action_delete = "javascript:show_form_delete('".$menu->id."')";
                        
                        return '<a href="'.$action_edit.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        <a href="'.$action_delete.'"
                         class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>';
            })->make(true);
    }

    public function get_data_landing_set_update(){        
        $response = array();
        $datasLcw = ManageLcw::find('1');   

        $response['id'] = $datasLcw->id;
        $response['title'] = $datasLcw->title;
        $response['content'] = $datasLcw->content;
        $response['link_to_name'] = $datasLcw->link_to_name;
        $response['display_link_to_name'] = $datasLcw->display_link_to_name;
        $response['link_to_href'] = $datasLcw->link_to_href;
        $response['link_videos'] = $datasLcw->link_videos;
        $response['new_tab'] = $datasLcw->new_tab;
        $response['content_foo'] = $datasLcw->content_foo;
        $response['sub_content_foo'] = $datasLcw->sub_content_foo;
        $response['blue_text_foo'] = $datasLcw->blue_text_foo;

        $response['status'] = 'success';
        echo json_encode($response);   
    }

    public function get_data_menu_set_update(Request $req){
        
        $response = array();
        $setMenu = HomeMenu::find($req->id);   

        $response['id'] = $setMenu->id;
        $response['index'] = $setMenu->index;
        $response['nameMenu'] = $setMenu->name;
        $response['display_name'] = $setMenu->display_name;
        $response['href'] = $setMenu->href;
        $response['new_tab'] = $setMenu->new_tab;

        $response['status'] = 'success';
        echo json_encode($response);   
    }

    public function post_new_menu(Request $req){
        $response = array();

        $param = $req->all();

        $rules = array(
            'nameMenu'   => 'required',
            'display_name'   => 'required',
            'href'   => 'required',
        );
        $validate = Validator::make($param,$rules);

        $newMenu = new HomeMenu;
        $index = "";
        $nameMenu = "";
        $display_name = "";
        $href = "";
        $newTabMenu = "";
        
        
        foreach($req->all() as $name => $value){
            if($name == "nameMenu"){
                $nameMenu = $value;    
            }else if($name == "display_name"){
                $display_name = $value;    
            }else if($name == "href"){
                $href = $value;    
            }else if($name == 'index'){
                $index = $value;
            }else if($name == "newTabMenu"){
                $newTabMenu = $value;
            }else if ($name == "_token"){

            }else if ($name == "id"){

            }
        }

        if($validate->fails()) {
            $this->validate($req,$rules);
        }else {
            $newMenu->index = $index;
            $newMenu->name = $nameMenu;
            $newMenu->display_name = $display_name;
            $newMenu->href = $href;
            $newMenu->new_tab = $newTabMenu;
            $newMenu->save();

            $response['notification'] = 'Success Add Menu';
            $response['status'] = 'success';
        }
        echo json_encode($response);
    }

    public function post_edit_menu(Request $req){
        $response = array();
    
        if($req->method != 'delete'){
            $param = $req->all();
            $rules = array(
                'nameMenu'   => 'required',
                'display_name'   => 'required',
                'href'   => 'required',
            );

            $validate = Validator::make($param,$rules);
            $editMenu = HomeMenu::find($req->id);                    
            $index = "";
            $nameMenu = "";
            $display_name = "";
            $href = "";
            $newTabMenu = "";
            
            foreach($req->all() as $name => $value){
                if($name == "nameMenu"){
                    $nameMenu = $value;    
                }else if($name == "display_name"){
                    $display_name = $value;    
                }else if($name == "href"){
                    $href = $value;    
                }else if($name == 'index'){
                    $index = $value;
                }else if($name == 'newTabEdit'){
                    $newTabMenu = $value;
                }else if ($name == "_token"){

                }else if ($name == "id"){

                }
            }
            
            if($validate->fails()) {
                $this->validate($req,$rules);
            } else {
                $editMenu->index = $index;
                $editMenu->name = $nameMenu;
                $editMenu->display_name = $display_name;
                $editMenu->href = $href;
                $editMenu->new_tab = $newTabMenu;

                $editMenu->save();
                
                $response['notification'] = "Success Edit Menu";
                $response['status'] = "success";
            }
        }else{            
            $response = array();
            $editMenu = HomeMenu::find($req->id);
            if ($editMenu->delete()) {
                $response['notification'] = 'Delete Menu Success';
                $response['status'] = "success";
            } else {
                $response['notification'] = 'Delete Menu Failed';
                $response['status'] = 'failed';
            }
        }

        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * Datatables for Menu Management.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Handle create and edit method.
     *
     * @param  array  $datatoBind
     * @param  int    $id
     * @return \Illuminate\Http\Response
     */
    protected function createEdit($dataToBind, $id = 0)
    {

    }

    /**
     * Handle store and update method.
     *
     * @param  \App\Http\Requests\Backend\UserTrustee\MenuRequest $request
     * @param  int                                          $id
     * @return \Illuminate\Http\Response
     */
    private function storeUpdate(Request $request, $id = 0)
    {
        
    }

    public function ajaxGetValueLcw(Request $request)
    {
        $section = $request->input('id');
        $records = [];
        if ($section != '') {
            $records = DB::table('landing_webs')->select('id', 'section', 'title', 'content', 'sub_title', 'sub_title_2', 'link_video')->where('section', '=', $section)->get();
        } 

        return json_encode($records);
    }


}
