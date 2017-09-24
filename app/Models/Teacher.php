<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'position', 
        'photo', 
        'academic', 
        'organization',
        'province',
        'district',
        'region',
        'address',
        'postal_code',
        'facebook',
        'instagram',
        'linkedin',
        'quote',
        'post_by',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $teachers ) {   
                if($teachers->photo != ""){  
                    $image_path = public_path().'/storage/avatars/'.$teachers->photo;
                    if(file_exists($image_path))
                        unlink($image_path);
                }
           });
    }


    public static function datatables()
    {
        return static::select('id','name', 'email', 'phone', 'position', 'photo', 'academic', 'organization', 'province', 'district', 'region', 'address', 'postal_code', 'facebook', 'instagram', 'linkedin', 'quote')->get();
    }
    public static function getTeacher($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq_teacher = Teacher::where('id',$id);
            if($eloq_teacher->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq_teacher->get()->first()->photo != ''){
                        return asset($pathp.'storage/avatars').'/'.$eloq_teacher->get()->first()->photo;
                    }else{
                        return asset($pathp.'assets/backend/porto-admin/images/!logged-user.jpg');
                    }
                }else{
                    return $eloq_teacher->get()->first()->{$field};                    
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
