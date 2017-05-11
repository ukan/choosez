<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = ['name','email','subject','message'];
}