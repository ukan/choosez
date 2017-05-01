<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Album;
use DB;

class GalleryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        $data = DB::table('album')->select(DB::RAW('DISTINCT(album.id)'),'album.name','album.image','album.date')
                ->join('gallery','gallery.album_id','=','album.id')
                ->orderBy('id')->get();

        $getData = [];
        $x = 0;
        foreach ($data as $key => $value) {
            $getData[$x] = $value;

            $x++;
        }

        return view('frontend.gallery.index')->with('album', $getData);
    }

    public function galleryDetail($id)
    {   
        $beforeDecrypt = str_replace('zpaIwL8TvQqP','/',$id);
        $cryptKey   = 'qJB0rGtIn5UB1xG03efyCp';
        $decrypted  = rtrim( mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),base64_decode($beforeDecrypt), 
                MCRYPT_MODE_CBC,md5(md5($cryptKey))), "\0");
        
        $data = Gallery::where('album_id',$decrypted)->orderBy('id')->get();

        $getData = [];
        $x = 0;
        foreach ($data as $key => $value) {
            $getData[$x] = $value;

            $x++;
        }
        return view('frontend.gallery.detail_album')->with('album', $getData);
    }
}