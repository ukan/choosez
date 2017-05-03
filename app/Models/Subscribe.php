<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Subscribe extends Model
{
    protected $table = 'subscribes';

    protected $fillable = [
        'email',
    ];
}
