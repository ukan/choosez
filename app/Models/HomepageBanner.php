<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class HomepageBanner extends Model
{
    protected $table = 'homepage_banner';

    protected $fillable = [
        'name',
        'image',
        'link',
        'index_order',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $data ) {   
                if($data->image != ""){  
                    $image_path = public_path().'/storage/banner/'.$data->image;
                    if(file_exists($image_path))
                        unlink($image_path);
                }
           });
    }

    public static function getBanner($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq = self::where('id',$id);
            if($eloq->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq->get()->first()->image != ''){
                        return asset($pathp.'storage/banner').'/'.$eloq->get()->first()->image;
                    }else{
                        return asset($pathp.'assets/backend/porto-admin/images/!logged-user.jpg');
                    }
                }else{
                    return $eloq->get()->first()->{$field};                    
                }
            }else{
                // format Error
                return '';
            }
        }else{
                return '';
        }
    }
}
