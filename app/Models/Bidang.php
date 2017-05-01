<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bidang extends Model
{
    protected $table = 'bidang';

    protected $fillable = ['nama_bidang'];
}
