<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Asrama extends Model
{
    protected $table = 'asrama';

    protected $fillable = ['nama_asrama'];
}
