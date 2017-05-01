<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'album_id', 
        'image',
    ];

    protected static function boot() {
           parent::boot();
           static::deleting( function( $data ) {   
                if($data->image != ""){  
                    $image_path = public_path().'/storage/gallery/'.$data->image;
                    unlink($image_path);
                }
           });
    }
}
