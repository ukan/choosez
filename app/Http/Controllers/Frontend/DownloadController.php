<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\DownloadCategory;

class DownloadController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        #-- Get Editor Data
        $downloadData = Download::orderBy('created_at', 'desc')->paginate(5);

        return view('frontend.download.index', ['downloads' => $downloadData]);
    }

    public function detail($slug){
        $data       = Download::where('slug',$slug)->orderBy('id')->first();
        if(!empty($data->category)){
            $category   = DownloadCategory::whereIn('id', json_decode($data->category,TRUE))->pluck('name')->all();
            $data['category'] = $category;
        }

        return view('frontend.download.downloadDetail')->with('download', $data);
    }
}