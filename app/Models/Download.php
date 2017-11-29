<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Download extends Model
{
    protected $table = 'downloads';

    protected $fillable = [
        'title',
        'image_path',
        'description',
        'link',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $download ) {   
                if($download->image_path != ""){  
                    $image_path = public_path().'/storage/downloads/'.$download->image_path;
                    if(file_exists($image_path))
                        unlink($image_path);
                }
           });
    }

    public static function datatables()
    {
        return static::select('id','title', 'image_path', 'link')->get();
    }
    public static function getDownload($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq = self::where('id',$id);
            if($eloq->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq->get()->first()->image_path != ''){
                        return asset($pathp.'storage/downloads').'/'.$eloq->get()->first()->image_path;
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
