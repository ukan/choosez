<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Organigram;

class AcademicController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexSchedule()
    {   
        $schedule = Organigram::where('id',2)->get()->first();
        
        return view('frontend.academic.schedule')->with('schedule',$schedule);
    }
    public function indexMaterial()
    {   
        $book = Book::orderBy('id')->get();

        $getBook = [];
        $x = 0;
        foreach ($book as $key => $value) {
            $getBook[$x] = $value;

            $x++;
        }

        return view('frontend.academic.material')->with('book', $getBook);
    }

    public function indexAcademicSupport()
    {   
        return view('frontend.academic.academicSupport');
    }
}