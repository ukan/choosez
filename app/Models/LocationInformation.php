<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class LocationInformation extends Model
{
    protected $table = 'location_informations';

    protected $fillable = [
        'id', 'code', 'name', 'province_id', 'district_id', 'sub_district_id', 'village_id',
    ];


    public static function getLocationInformation($id="",$field="")
    {
        if($field == 'province'){                    
	        $location = LocationInformation::find($id);
	        if(!empty($location)){
	            $province_id = $location->province_id;
	            $district_id = $location->district_id;
	            $sub_district_id = $location->sub_district_id;
	            return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=','0')->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get()->first()->name));
	        }else{
	            return '';
	        }
        }else if($field == 'city'){                    
            $location = LocationInformation::find($id);
            if($location){
                $province_id = $location->province_id;
                $district_id = $location->district_id;
                $sub_district_id = $location->sub_district_id;
                return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=','0')->where('village_id','=','0')->orderBy('name')->get()->first()->name));
            }else{
                return '';
            }
        }else if($field == 'district'){                    
            $location = LocationInformation::find($id);
            if(!empty($location)){
                $province_id = $location->province_id;
                $district_id = $location->district_id;
                $sub_district_id = $location->sub_district_id;
                return ucwords(strtolower(LocationInformation::where('province_id','=',$province_id)->where('district_id','=',$district_id)->where('sub_district_id','=',$sub_district_id)->where('village_id','=','0')->orderBy('name')->get()->first()->name));
            }else{
                return '';
            }
		}else{
			return '';
		}        
    }
}