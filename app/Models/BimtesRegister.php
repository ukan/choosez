<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BimtesRegister extends Model
{
    protected $table = 'bimtes_register';

    protected $fillable = [
        'name', 
        'place_of_birth', 
        'date_of_birth', 
        'address',
        'phone',
        'email',
        'slta',
        'slta_th',
        'gender',
        'image_confirm',
        'major1',
        'major2',
        'photo',
        'test_day',
        'test_number',
    ];
}
