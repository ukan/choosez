<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Kementerian extends Model
{
    protected $table = 'kementerian';

    protected $fillable = [
        'bidang_id', 
        'menteri', 
        'sekretaris', 
        'bendahara', 
        'anggota',
    ];
}
