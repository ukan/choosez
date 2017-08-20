<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthLogMos extends Model
{
    protected $table = 'auth_log_mos';

    /**
     * {@inheritDoc}
     */
    
    protected $fillable = [
        'mos_register_id','ip_address', 'login', 'logout',
    ];
}
