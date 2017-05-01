<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    protected $table = 'activations';

    protected $fillable = [
        'user_id','code','completed',
    ];
    
    public function User()
    {
        return $this->hasMany('App\Models\User','user_id');
    }
}
