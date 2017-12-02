<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class DownloadCategory extends Model
{
    protected $table = 'download_category';

    protected $fillable = [
        'name',
    ];

    /**
     * Datatable.
     *
     * @return void
     */
    public static function datatables()
    {
        return static::select('id','name')->get();
    }

    /**
     * Dropdown list for download category.
     *
     * @return array
     */
    public static function dropdown()
    {
        return static::orderBy('name')->lists('name', 'id');
    }
}
