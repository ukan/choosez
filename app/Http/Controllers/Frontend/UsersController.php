<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\LocationInformation;
use App\Models\RoomList;
use App\Models\User;
use App\Http\Controllers\Controller;

use Validator;
use Session;
use Sentinel;
use Mail;
use Hash;

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

    public function resetPassword() 
    {
        return view('frontend.partials.reset_password');
    }

    public function processResetPassword(Request $request) 
    {
        $valid = array(
          'email' => 'required|email'
        );
        $data = $request->all();
        $validate = Validator::make($data, $valid);
        $find_data = User::where('email','=', $request->email)->first();
        if($validate->fails()) {
          return redirect('in/reset-password')
          ->withErrors($validate)
          ->withInput();

        }elseif(empty($find_data)) {
          Session::flash('error', 'Email not found ');
          return redirect('in/reset-password')
            ->withErrors($validate)
            ->withInput();

        }else{
      // dd($find_data);
            $find_data->forgot_token = str_random(30);
            $find_data->save();
            Mail::send('email.reset_password', $find_data->toArray(), function($message) use($find_data) {
                $message->from("noreply@ponpesalihsancbr.id", 'Al-Ihsan No-Reply');
                $message->to($find_data->email, $find_data->first_name)->subject('Reset Password Instruction to Al Ihsan');
            });
            flash()->error('Check your email for reset your password');
            return redirect(route('admin-login-member'));

        }
    }


    public function changePassword($forgot_token) 
    {

        $find_user = User::where('forgot_token','=', $forgot_token)->first();
        if(empty($find_user)) {

          Session::flash('error', 'Token not valid');
            return redirect(route('reset-password'));

        } else {
          Session::flash('notice', 'Token valid Lets Change Your Password');

          return view('auth.change-password')
            ->with( 'forgot_token', $find_user->forgot_token);

        }
    }


    public function processChangePassword(Request $request) 
    {
        $param = $request->all();
        
        $valid = array(
            'password' => ('required|min: 8|confirmed')
        );

        $data = $request->all();
        $find_data = Sentinel::findRoleBySlug('member')->users()->where('forgot_token','=', $param['forgot_token']);
        $validate = Validator::make($data, $valid);

        if($validate->fails()) {
            if($find_data->count() > 0){                
                $user = $find_data->first();
                return redirect('in/change-password/'.$user->forgot_token)->withErrors($validate);
            }else{
                return view('frontend.partials.error_404');
            }
        } else {
            if($find_data->count() > 0){
                $user = $find_data->first();
                $user->password = Hash::make($request->password);
                $user->forgot_token = null;
                $user->save();
            }
          Session::flash('notice', 'Password has change, lets login');
          return redirect()->route('admin-login-member');

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
