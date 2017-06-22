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
        'password',
        'phone',
        'email',
        'status',
        'slta',
        'slta_th',
        'gender',
        'image_confirm',
        'major1',
        'major2',
        'major3',
        'photo',
        'test_day',
        'test_number',
    ];

    public static function datatablesBimtesRegister($isAdmin = null)
    {
        return static::select(
            'id',
            'photo',
            'name',
            'phone',
            'email',
            'test_number',
            'test_day',
            'status',
            'updated_at'
        );

        return $return;
    }
}
