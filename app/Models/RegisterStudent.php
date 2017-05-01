<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RegisterStudent extends Model
{
    protected $table = 'register_student';

    protected $fillable = [
        'name', 
        'nick_name', 
        'place_of_birth', 
        'date_of_birth', 
        'address',
        'rt',
        'rw',
        'village',
        'sub_district',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'sd',
        'sd_th',
        'sltp',
        'sltp_th',
        'slta',
        'slta_th',
        'mbs',
        'university',
        'faculty',
        'major',
        'semester',
        'father_name',
        'fahter_age',
        'f_last_study',
        'f_current_job',
        'mother_name',
        'mother_age',
        'm_last_study',
        'm_current_job',
    ];
}
