<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Organigram extends Model
{
    protected $table = 'organigram';

    protected $fillable = [
    	'asrama_id',
    	'nama',
    	'image',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $organigram ) {   
                if($organigram->image != ""){  
                    $image_path = public_path().'/storage/organigram/'.$organigram->image;
                    if(file_exists($image_path))
                        unlink($image_path);
                }
           });
    }

    public static function getOrganigram($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq = Organigram::where('id',$id);
            if($eloq->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq->get()->first()->image != ''){
                        return asset($pathp.'storage/organigram').'/'.$eloq->get()->first()->image;
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