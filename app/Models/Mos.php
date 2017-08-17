<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mos extends Model
{
    protected $table = 'mos';

    /**
     * {@inheritDoc}
     */
    
    protected $fillable = [
        'id',
        'name', 
        'email', 
        'place_of_birth',
        'date_of_birth',
        'address',
        'dorm',
        'room',
        'major',
        'phone',
        'tshirtSize',
        'gender',
        'image_confirm',
    ];
}
