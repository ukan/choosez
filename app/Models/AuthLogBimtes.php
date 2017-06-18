<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthLogBimtes extends Model
{
    protected $table = 'auth_log_bimtes';

    /**
     * {@inheritDoc}
     */
    
    protected $fillable = [
        'bimtes_register_id','ip_address', 'login', 'logout',
    ];
}
