<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditrailLog extends Model
{
    protected $table = 'auditrail_log';

    /**
     * {@inheritDoc}
     */
    
    protected $fillable = [
        'email','action', 'table_name', 'before', 'after', 'content',
    ];
}
