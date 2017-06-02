<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bimtes extends Model
{
    protected $table = 'bimtes';

    protected $fillable = [
        'title',
        'content',
    ];
}
