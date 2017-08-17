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
        'address',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'dorm',
        'room',
        'major',
        'email', 
        'phone',
        'tsirt_size',
        'image_confirm',
        'status',
    ];

    public static function datatables($isAdmin = null)
    {
        return static::select(
            'id',
            'name',
            'email',
            'phone',
            'dorm',
            'room',
            'status',
            'updated_at'
        );

        return $return;
    }
}
