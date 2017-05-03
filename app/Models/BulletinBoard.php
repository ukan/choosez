<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class BulletinBoard extends Model
{
    protected $table = 'buletin_boards';

    protected $fillable = [
        'title', 'content', 'img_url', 'author', 'publish_date', 'publish_status', 'status',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $bulletin_board ) {   
                if($bulletin_board->img_url != ""){  
                    $image_path = public_path().'/storage/news/'.$bulletin_board->img_url;
                    unlink($image_path);
                }
           });
    }

    public static function getBulletinBoard($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq_bulletin_board = BulletinBoard::where('id',$id);
            if($eloq_bulletin_board->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq_bulletin_board->get()->first()->img_url != ''){
                        return asset($pathp.'storage').'/'.$eloq_bulletin_board->get()->first()->img_url;
                    }else{
                        return asset('assets/backend/porto-admin/images/!logged-user.jpg');
                    }
                }else{
                    return $eloq_bulletin_board->get()->first()->{$field};                    
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
