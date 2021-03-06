<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Album extends Model
{
    protected $table = 'album';

    protected $fillable = [
        'name',
        'date',
        'link_donwload',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $data ) {   
                if($data->image != ""){  
                    $image_path = public_path().'/storage/gallery/'.$data->image;
                    if(file_exists($image_path))
                        unlink($image_path);
                }
           });
    }

    public static function getAlbum($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq = Album::where('id',$id);
            if($eloq->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq->get()->first()->image != ''){
                        return asset($pathp.'storage/gallery').'/'.$eloq->get()->first()->image;
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
