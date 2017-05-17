<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\LocationInformation;
use App\Models\RoomList;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('frontend.profile.index');
    }
    public function changePassword()
    {
        // return view('frontend.profile.change-password');
    }

    public function processRoomList($type="",$id=""){
        if ($type == 'hostel'){
            if (ctype_digit($id)) {
                $query = RoomList::where('parent','=',$id)->orderBy('name')->get();
                echo"<option selected value=''>Pilih Kamar</option>";
                foreach($query as $row){
                    echo "<option value='".$row['id']."'>".ucwords(strtolower($row['name']))."</option>";
                }
            }
        }
    }

    public function processLocationInformation($type="",$id="",$id_prov="")
    {                
        if ($type == 'province'){
            if (ctype_digit($id)) {
                $query = LocationInformation::where('province_id','=',$id)->where('district_id','!=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get();
                echo"<option selected value=''>Pilih Kabupaten/Kota</option>";
                foreach($query as $row){
                    echo "<option value='".$row['district_id']."/".$id."'>".ucwords(strtolower($row['name']))."</option>";
                }


            }
        }
        if ($type != 'village'){

            if ($type == 'subdistrict' and $id_prov != ''){
                if (ctype_digit($id) and ctype_digit($id_prov)) {
                    $query = LocationInformation::where('province_id','=',$id_prov)->where('district_id','=',$id)->where('sub_district_id','!=','0')->where('village_id','=','0')->orderBy('name')->get();
                    echo"<option selected value=''>Pilih kecamatan</option>";
                    foreach($query as $row){
                        echo "<option value='".$row['sub_district_id']."'>".ucwords(strtolower($row['name']))."</option>";
                    }
                }
            }
        } else {
            if ($type == 'subdistrict' and $id_prov != ''){
                if (ctype_digit($id) and ctype_digit($id_prov)) {
                    $query = LocationInformation::where('province_id','=',$id_prov)->where('district_id','=',$id_district)->where('sub_district_id','=',$id)->where('village_id','!=','0')->orderBy('name')->get();
                     echo"<option selected value=''>Choice Village</option>";
                    foreach($query as $row){
                        echo "<option value='".$row['id']."'>".ucwords(strtolower($row['name']))."</option>";
                    }
                }
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
