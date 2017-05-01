<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Proker extends Model
{
    protected $table = 'proker';

    protected $fillable = [
        'bidang_id', 
        'proker_mingguan', 
        'proker_bulanan', 
        'proker_tahunan', 
        'proker_kondisional',
    ];
}
