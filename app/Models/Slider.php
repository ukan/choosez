<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Slider extends Model
{
    protected $table = 'slider';

    protected $fillable = [
    	'id',
    	'category',
    	'image',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $slider ) {   
                if($slider->image != ""){  
                    $image_path = public_path().'/storage/slider/'.$slider->image;
                    unlink($image_path);
                }
           });
    }

    public static function getSlider($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq = Slider::where('id',$id);
            if($eloq->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq->get()->first()->image != ''){
                        return asset($pathp.'storage/slider').'/'.$eloq->get()->first()->image;
                    }else{
                        return asset($pathp.'assets/backend/porto-admin/images/!logged-user.png');
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