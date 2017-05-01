<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserRequest extends Model
{
    protected $table = 'user_requests';

    protected $fillable = [
        'user_id','code','type' , 'name', 'reason', 'status',
    ];

    public function User() {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
