<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Organigram;
use App\Models\RoomList;

class AcademicController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexSchedule()
    {   
        $kamar = RoomList::find(user_info('location_information_id'));
        dd($kamar);
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