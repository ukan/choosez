<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Organigram;
use App\Models\Bidang;
use App\Models\Slider;

class OrganizationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexCenter()
    {   
        $struktur = Organigram::where('id',1)->get()->first()->image;
        $bidang = Bidang::where('id','>',2)->get();
        
        return view('frontend.organization.center')
                 ->with('struktur', $struktur)
                 ->with('bidang', $bidang);
    }

    public function indexRegion()
    {   
        $struktur = Organigram::where('id',1)->get()->first()->image;
        $asrama = Organigram::where('asrama_id','!=',null)->orderBy('asrama_id','asc')->get();
        
        return view('frontend.organization.region')
                 ->with('struktur', $struktur)
                 ->with('bidang', $asrama);
    }

    public function indexUks()
    {   
        $slider = Slider::where('category', 'UKS')->get();
        
        return view('frontend.organization.uks')->with('slider', $slider);
    }
}