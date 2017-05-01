<?php

namespace App\Models;
 

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\User;
use App\Models\Roles;
use App\Models\BulletinBoard;
use App\Models\LocationInformation;

use Input;
use Carbon\Carbon;
class BackendHqDashboard extends Model
{
    public static function Index($code='year')
    {
        return view('backend.admin.dashboard.hq');
    }
    
    public static function ShowProvinceOption(){
        $response = array();
        $select_province = '<option value="">Choose Province</option>';
        $query = LocationInformation::where('district_id','=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get();
        foreach($query as $row){
            $select_province .= "<option value='".$row['province_id']."'>".ucwords(strtolower($row['name']))."</option>";
            }
        $response['select_province'] = $select_province;
        echo json_encode($response);

    }

    public static function ShowUserOption(){
        $response = array();
        $select_user = '<option value="">Choose User</option>';
        $query = User::whereHas( 'roles', function( $role ) {
           $role->whereSlug( 'member' );})->get();
        foreach($query as $row){
            $select_user .= "<option value='".$row['id']."'>".$row['member_id']."-".$row['first_name'].$row['last_name']."</option>";
            }
        $response['select_user'] = $select_user;
        echo json_encode($response);

    }
    
    public static function AjaxPaginationBulletinBoard($request)
    {

        $bulletin_boards = BulletinBoard::where([
                            ['publish_status','=','on']
                        ])->orderBy('created_at', 'desc')->paginate(3);
        return view('frontend.member.dashboard.ajax_page_bulletin_boards')->with('bulletin_boards', $bulletin_boards);
    }
}
