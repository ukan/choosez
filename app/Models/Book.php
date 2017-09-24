<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Book extends Model
{
    protected $table = 'kajian';

    protected $fillable = [
        'image', 
        'kitab', 
        'pengarang',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $book ) {   
                if($book->image != ""){  
                    $image_path = public_path().'/storage/books/'.$book->image;
                    if(file_exists($image_path))
                        unlink($image_path);
                }
           });
    }


    public static function datatables()
    {
        return static::select('id','image', 'kitab', 'pengarang')->get();
    }
    public static function getBook($id="",$field="")
    {   
        $pathp = "";

        ((Config::get('app.env') == "local") ? $pathp="" : $pathp="public/" );

        if($id != ''){
            $eloq_book = Book::where('id',$id);
            if($eloq_book->count() == 1){     

                if($field == 'image_path'){ 
                    if($eloq_book->get()->first()->image != ''){
                        return asset($pathp.'storage/books').'/'.$eloq_book->get()->first()->image;
                    }else{
                        return asset($pathp.'assets/backend/porto-admin/images/!logged-user.jpg');
                    }
                }else{
                    return $eloq_book->get()->first()->{$field};                    
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