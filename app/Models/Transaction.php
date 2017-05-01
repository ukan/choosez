<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'code', 'type', 'from_bank_name', 'from_bank_account_number', 'coin_id', 'plan_id', 'user_id',
    ];
}
