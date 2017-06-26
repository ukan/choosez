<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table = 'suggestions';

    /**
     * {@inheritDoc}
     */
    
    protected $fillable = [
        'user_id', 'subject', 'content','status','read_by'
    ];
}
