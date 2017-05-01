<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Slider;

class PesantrenController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexHistory()
    {   
        $slider = Slider::where('category', 'History')->get();
        return view('frontend.profile_pesaantren.history')->with('slider', $slider);
    }
    public function indexStructure()
    {   
        $slider = Slider::where('category', 'Structure')->get();
        return view('frontend.profile_pesaantren.structure')->with('slider', $slider);
    }
    public function indexTeacher()
    {   
        $teacher = Teacher::orderBy('id')->get();

        $getTeacher = [];
        $x = 0;
        foreach ($teacher as $key => $value) {
            $getTeacher[$x] = $value;

            $x++;
        }

        return view('frontend.profile_pesaantren.teacher')->with('teacher', $getTeacher);
    }
    public function indexAchievement()
    {   
        $slider = Slider::where('category', 'Achievement')->get();
        return view('frontend.profile_pesaantren.achievement')->with('slider', $slider);
    }

    public function teacherDetail($id)
    {   
        $beforeDecrypt = str_replace('zpaIwL8TvQqP','/',$id);
        $cryptKey   = 'qJB0rGtIn5UB1xG03efyCp';
        $decrypted  = rtrim( mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),base64_decode($beforeDecrypt), 
                MCRYPT_MODE_CBC,md5(md5($cryptKey))), "\0");
        
        $teacher = Teacher::where('id',$decrypted)->orderBy('id')->get();

        $getTeacher = [];
        $x = 0;
        foreach ($teacher as $key => $value) {
            $getTeacher[$x] = $value;

            $x++;
        }
        return view('frontend.profile_pesaantren.detail_teacher')->with('teacher', $getTeacher);
    }
}