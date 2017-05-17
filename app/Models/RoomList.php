<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomList extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'room_lists';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'parent', 'name', 'pattern', 'is_parent',
    ];
}
