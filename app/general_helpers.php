<?php
use App\Models\User;
use App\Models\LocationInformation;
use App\Models\RoomList;
use Carbon\Carbon;

if (! function_exists('user_info')) {
    /**
     * Get logged user info.
     *
     * @param  string $column
     * @return mixed
     */
    function user_info($column = null)
    {
        if ($user = Sentinel::check()) {
            if (is_null($column)) {
                return $user;
            }

            if ('full_name' == $column) {
                return user_info('username');
            }

            if ('role' == $column) {
                return user_info()->roles[0];
            }

            if ('avatar_path' == $column) {
                    $pathp = "";
                    ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
                if(user_info('image') == null){
                    return asset($pathp.'assets/general/images/default/avatar.png');
                }else{
                    return asset($pathp.'storage/student').'/'.user_info('image');
                }
            }

            if ('country' == $column) {
                return 'Indonesia';
            }

            if ('province' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $sub_district_id = $location->sub_district_id;
                    return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get()->first()->name));
                }else{
                    return '';
                }
            }

            if ('city' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if($location){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $sub_district_id = $location->sub_district_id;
                    return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get()->first()->name));
                }else{
                    return '';
                }
            }

            if ('district' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $sub_district_id = $location->sub_district_id;
                    return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=',$sub_district_id)->where('village_id','=','0')->orderBy('name')->get()->first()->name));
                }else{
                    return '';
                }
            }

            if ('select_province' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                }else{
                    $province_id = 0;
                }
                $select_province = '';
                $query = LocationInformation::where('district_id','=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get();
                foreach($query as $row){
                        if($row['province_id'] == $province_id)
                        {
                            $selected = 'selected';
                        }
                        else{
                            $selected = '';
                        }
                        $select_province .= "<option value='".$row['province_id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                    }
                echo  $select_province;
            }

            if ('select_city' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $select_city = '';
                    $query = LocationInformation::where('province_id','=',$province_id)->where('district_id','!=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get();
                    foreach($query as $row){
                            if($row['district_id'] == $district_id)
                            {
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            $select_city .= "<option value='".$row['district_id']."/".$row['province_id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                        }
                    echo  $select_city;
                }else{
                    return '';
                }
            }

            if ('select_district' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $sub_district_id = $location->sub_district_id;
                    $select_district = '';
                    $query = LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','!=','0')->where('village_id','=','0')->orderBy('name')->get();
                    foreach($query as $row){
                            if($row['sub_district_id'] == $sub_district_id)
                            {
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            $select_district .= "<option value='".$row['sub_district_id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                        }
                    echo  $select_district;
                }else{
                    return '';
                }
            }

            if ('select_asrama' == $column) {
                $asrama = RoomList::find(null);
                if(!empty($asrama)){
                    $asrama_id = $asrama->id;
                }else{
                    $asrama_id = 0;
                }

                $select_asrama = '';
                $query = RoomList::where('parent','=',null)->orderBy('name')->get();
                foreach($query as $row){
                        if($row['id'] == $asrama_id)
                        {
                            $selected = 'selected';
                        }
                        else{
                            $selected = '';
                        }
                        $select_asrama .= "<option value='".$row['id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                    }
                echo  $select_asrama;
            }

            if ('select_kamar' == $column) {
                $kamar = RoomList::find(null);
                if(!empty($kamar)){
                    $id = $kamar->id;
                    $parent = $kamar->parent;
                    $select_room = '';
                    $query = RoomList::where('parent','=',$id)->orderBy('name')->get();
                    foreach($query as $row){
                            if($row['parent'] == $parent)
                            {
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            $select_room .= "<option ".((Input::old("kamar") == $row['parent']) ? "selected='selected'" : "")." value='".$row['parent']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                        }
                    echo  $select_room;
                }else{
                    return '';
                }
            }

            return $user->{$column};
        } else {
            if ('province' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $sub_district_id = $location->sub_district_id;
                    return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get()->first()->name));
                }else{
                    return '';
                }
            }

            if ('city' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if($location){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $sub_district_id = $location->sub_district_id;
                    return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get()->first()->name));
                }else{
                    return '';
                }
            }

            if ('district' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $sub_district_id = $location->sub_district_id;
                    return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=',$sub_district_id)->where('village_id','=','0')->orderBy('name')->get()->first()->name));
                }else{
                    return '';
                }
            }

            if ('select_province' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                }else{
                    $province_id = 0;
                }
                $select_province = '';
                $query = LocationInformation::where('district_id','=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get();
                foreach($query as $row){
                        if($row['province_id'] == $province_id)
                        {
                            $selected = 'selected';
                        }
                        else{
                            $selected = '';
                        }
                        $select_province .= "<option ".((Input::old("province") == $row['province_id']) ? "selected='selected'" : "")." value='".$row['province_id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                    }
                echo  $select_province;
            }

            if ('select_city' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $select_city = '';
                    $query = LocationInformation::where('province_id','=',$province_id)->where('district_id','!=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get();
                    foreach($query as $row){
                            if($row['district_id'] == $district_id)
                            {
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            $select_city .= "<option ".((Input::old("city") == $row['district_id']) ? "selected='selected'" : "")." value='".$row['district_id']."/".$row['province_id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                        }
                    echo  $select_city;
                }else{
                    return '';
                }
            }

            if ('select_district' == $column) {
                $location = LocationInformation::find(user_info('location_information_id'));
                if(!empty($location)){
                    $province_id = $location->province_id;
                    $district_id = $location->district_id;
                    $sub_district_id = $location->sub_district_id;
                    $select_district = '';
                    $query = LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','!=','0')->where('village_id','=','0')->orderBy('name')->get();
                    foreach($query as $row){
                            if($row['sub_district_id'] == $sub_district_id)
                            {
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            $select_district .= "<option value='".$row['sub_district_id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                        }
                    echo  $select_district;
                }else{
                    return '';
                }
            }

            if ('select_asrama' == $column) {
                $asrama = RoomList::find(null);
                if(!empty($asrama)){
                    $asrama_id = $asrama->id;
                }else{
                    $asrama_id = 0;
                }

                $select_asrama = '';
                $query = RoomList::where('parent','=',null)->orderBy('name')->get();
                foreach($query as $row){
                        if($row['id'] == $asrama_id)
                        {
                            $selected = '';
                        }
                        else{
                            $selected = '';
                        }
                        $select_asrama .= "<option ".((Input::old("asrama") == $row['id']) ? "selected='selected'" : "")." value='".$row['id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";/*
                        $select_asrama .= "<option value='".$row['id']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";*/
                    }
                echo  $select_asrama;
            }

            if ('select_kamar' == $column) {
                $kamar = RoomList::find(null);
                if(!empty($kamar)){
                    $id = $kamar->id;
                    $parent = $kamar->parent;
                    $select_room = '';
                    $query = RoomList::where('parent','=',$id)->orderBy('name')->get();
                    foreach($query as $row){
                            if($row['parent'] == $parent)
                            {
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            $select_room .= "<option ".((Input::old("kamar") == $row['parent']) ? "selected='selected'" : "")." value='".$row['parent']."' ".$selected.">".ucwords(strtolower($row['name']))."</option>";
                        }
                    echo  $select_room;
                }else{
                    return '';
                }
            }
        }

        return null;
    }
}

if (! function_exists('link_to_avatar')) {
    /**
     * Generates link to avatar.
     *
     * @param  null|string $path
     * @return string
     */
    function link_to_avatar($path = null)
    {
        if (is_null($path) || $path == '' || ! file_exists(avatar_path($path))) {
            // return 'http://lorempixel.com/128/128/';
            $pathp = "";

            ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );
            return asset($pathp.'assets/general/images/default/avatar.png');
        }else{
            return asset('storage/avatars').'/'.trim($path, '/');
        }

    }
}

if (! function_exists('avatar_path')) {
    /**
     * Generates avatars path.
     *
     * @param  null|string $path
     * @return string
     */
    function avatar_path($path = null)
    {
        $link = public_path('storage/student');

        if (is_null($path)) {
            return $link;
        }

        return $link.'/'.trim($path, '/');
    }
}

if (! function_exists('datatables')) {
    /**
     * Shortcut for Datatables::of().
     *
     * @param  mixed $builder
     * @return mixed
     */
    function datatables($builder)
    {
        return Datatables::of($builder);
    }
}

if (! function_exists('eform_datetime')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function eform_datetime($datetime)
    {
        return date(env('APP_DATE_FORMAT', 'd M Y H:i:s'), strtotime($datetime));
    }
}

if (! function_exists('eform_date')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function eform_date($datetime)
    {
        return date(env('APP_DATE_FORMAT', 'd M Y'), strtotime($datetime));
    }
}

if (! function_exists('eform_date_news')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function eform_date_news($datetime)
    {
        return date(env('APP_DATE_FORMAT', 'M d, Y'), strtotime($datetime));
    }
}

if (! function_exists('eform_date_number')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function eform_date_number($datetime)
    {
        return date(env('APP_DATE_FORMAT', 'd'), strtotime($datetime));
    }
}

if (! function_exists('eform_date_month')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function eform_date_month($datetime)
    {
        return date(env('APP_DATE_FORMAT', 'M'), strtotime($datetime));
    }
}
if (! function_exists('eform_datemonth')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function eform_datemonth($datetime)
    {
        return date(env('APP_DATE_FORMAT', 'd M'), strtotime($datetime));
    }
}

if (! function_exists('has_access')) {
    /**
     * Check if user has access.
     *
     * @param  array|string  $permissions
     * @param  bool          $any
     * @return bool
     */
    function has_access($permissions, $any = false)
    {
        $method = 'hasAccess';
        if ($any) {
            $method = 'hasAnyAccess';
        }

        if ((bool) user_info('role')->is_super_admin) {
            return true;
        }

        return Sentinel::check()->{$method}($permissions);
    }
}

if (! function_exists('sentinel_check_role_admin')) {

    function sentinel_check_role_admin()
    {
        if(Sentinel::check()){
            if(strtolower(Sentinel::check()->roles[0]->slug) != 'member')
            {
                return true;
            }else{
                return false;
            }
        }else{
            return redirect('');
        }
    }
}

if (! function_exists('getClientIps')) {
    function getClientIps()
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }
        return $ipAddress;
    }
}

if (! function_exists('getFullUrl')) {
    function getFullUrl()
    {
        $getFullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $getFullUrl;
    }
}

if (! function_exists('getUser')) {
    function getUser($id="",$field="")
    {
        return User::getUser($id,$field);
    }
}

if (! function_exists('createdirYmd')) {
    function createdirYmd($path="")
    {
            if(!file_exists($path."/".date("Y"))) {
                mkdir($path."/".date("Y"), 0777,true);
                chmod($path."/".date("Y"), 0777);
            }
            if(!file_exists($path."/".date("Y")."/".date("m"))) {
                mkdir($path."/".date("Y")."/".date("m"), 0777,true);
                chmod($path."/".date("Y")."/".date("m"), 0777);
            }
            if(!file_exists($path."/".date("Y")."/".date("m")."/".date("d"))) {
                mkdir($path."/".date("Y")."/".date("m")."/".date("d"), 0777,TRUE);
                chmod($path."/".date("Y")."/".date("m")."/".date("d"), 0777);
            }
    }
}

if (! function_exists('slug')) {
    function slug($title,$to="")
    {
        $symbol_space = array(" ");
        $symbols = array(";","-",",","*","@","!","(",")",".","#","/","|","[","]",'"',"'","&","?","$","%","^","&","+","=","{","}",":",">","<",'\\');
        $output = str_replace($symbols, '', $title);
        $output = str_replace($symbol_space, '-', $output);
        return strtolower($output);
    }
}

function idr_format($value=0,$type="rp"){
    $decimals ="2";
    $decimal_point =",";
    $thousand_seperator =".";
    if($type == "rp"){
        $first_string = 'Rp ';
    }else if($type == "null"){
        $first_string = '';
        $decimals ="0";
    }
    return $first_string.number_format($value, $decimals, $decimal_point, $thousand_seperator);
}

function form_input_file_img($type = "", $name = "" , $url = "", $width = "", $height = "", $class = "", $id = "", $style = "", $alt = "", $title = "", $other = "")
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($url == ""){
            $url = asset($pathp.'assets/frontend/general/img/holder.png');
        }
                    if ($width != "") {
                        $width_img = "width: $width;";
                        $max_width_img = "max-width: $width;";
                    } else {
                        $width_img = "";
                        $max_width_img = "";
                    }
                    if ($height != "") {
                        $height_img = "height: $height;";
                        $max_height_img = "max-height: $height;";
                    } else {
                        $height_img = "";
                        $max_height_img = "";
                    }
        $var_css_1 = $width_img.$height_img;
        $var_css_2 = $max_width_img.$height_img;
        // $type file , image , video
        $output = '';
        $output .= '
        <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-right:10px">
          <div class="fileinput-new thumbnail '.$name.'" style="'.$var_css_1.'">';
        $output .= '<img src="'.$url.'" class="img-responsive">';
        $output .= '</div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="'.$var_css_2.'"></div>
          <div>
            <span class="btn btn-primary btn-file"><span class="fileinput-new"><i class="fa fa-camera"></i> Select Image</span><span class="fileinput-exists"><i class="fa fa-refresh"></i> Change</span><input type="file" name="'.$name.'" class="'.$class.'" accept="image/*"></span>
            <a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash-o"></i> Remove</a>
          </div>
        </div>
        ';
        return $output;
    }

function form_input_file_image($type = "", $name = "" , $url = "", $width = "", $height = "", $class = "", $id = "", $style = "", $alt = "", $title = "", $other = "")
    {
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($url == ""){
            $url = asset($pathp.'assets/frontend/general/img/holder.png');
        }
                    if ($width != "") {
                        $width_img = "width: $width;";
                        $max_width_img = "max-width: $width;";
                    } else {
                        $width_img = "";
                        $max_width_img = "";
                    }
                    if ($height != "") {
                        $height_img = "height: $height;";
                        $max_height_img = "max-height: $height;";
                    } else {
                        $height_img = "";
                        $max_height_img = "";
                    }
        $var_css_1 = $width_img.$height_img;
        $var_css_2 = $max_width_img.$height_img;
        // $type file , image , video
        $output = '';
        $output .= '
        <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-right:10px">
          <div class="fileinput-new thumbnail '.$name.'" style="'.$var_css_1.'">';
        $output .= '<img src="'.$url.'" class="img-responsive">';
        $output .= '</div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="'.$var_css_2.'"></div>
          <div>
            <span class="btn btn-primary btn-file"><span class="fileinput-new"><i class="fa fa-camera-retro"></i> Select</span><span class="fileinput-exists"><i class="fa fa-refresh"></i> Change</span><input type="file" name="'.$name.'" class="'.$class.'" accept="image/*"></span>
            <a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput"><i class="fa fa-remove"></i> Remove</a>
          </div>
        </div>
        ';
        return $output;
    }

function rmdirr($dirname)
{
    // Sanity check
    if (!file_exists($dirname)) {
        return false;
    }

    // Simple delete for a file
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }

    // Create and iterate stack
    $stack = array($dirname);
    while ($entry = array_pop($stack)) {
        // Watch for symlinks
        if (is_link($entry)) {
            unlink($entry);
            continue;
        }

        // Attempt to remove the directory
        if (@rmdir($entry)) {
            continue;
        }

        // Otherwise add it to the stack
        $stack[] = $entry;
        $dh = opendir($entry);
        while (false !== $child = readdir($dh)) {
            // Ignore pointers
            if ($child === '.' || $child === '..') {
                continue;
            }

            // Unlink files and add directories to stack
            $child = $entry . DIRECTORY_SEPARATOR . $child;
            if (is_dir($child) && !is_link($child)) {
                $stack[] = $child;
            } else {
                unlink($child);
            }
        }
        closedir($dh);
        // print_r($stack);
    }

    return true;
}

function getBackground(){
    $newTab = DB::table('manage_lcw')
            ->select('background')
            ->get();
        foreach ($newTab as $key => $value) {
            $back = $value->background;
        }

    return asset('storage/background').'/'.$back;
}

if (! function_exists('ahloo_form_title')) {
    /**
     * Generate title for form.
     *
     * @param  int    $id
     * @return string
     */
    function ahloo_form_title($id = 0)
    {
        return $id > 0 ? 'edit' : 'add';
    }
}
define('quotes',"'");
