<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class FinanceManagement extends Model
{
    protected $table = 'finance_management';

    protected $fillable = [
        'type', 
        'date', 
        'value', 
        'description',
        'update_at',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $bulletin_board ) {   
                if($bulletin_board->img_url != ""){  
                    $image_path = public_path().'/storage/news/'.$bulletin_board->img_url;
                    if(file_exists($image_path))
                        unlink($image_path);
                }
           });
    }

    public static function getFinance($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq_finance = FinanceManagement::where('id',$id);
            if($eloq_finance->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq_finance->get()->first()->img_url != ''){
                        return asset($pathp.'storage').'/'.$eloq_finance->get()->first()->img_url;
                    }else{
                        return asset($pathp.'assets/backend/porto-admin/images/!logged-user.jpg');
                    }
                }else{
                    return $eloq_finance->get()->first()->{$field};                    
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
