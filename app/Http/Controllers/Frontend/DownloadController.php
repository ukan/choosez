<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Download;

class DownloadController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        #-- Get Editor Data
        $downloadData = Download::paginate(5);

        return view('frontend.download.index', ['downloads' => $downloadData]);
    }
}