<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    public function duser()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }

    public function t7()
    {
        return $this->belongsTo('App\Models\Trader7', 'account_id');
    }
}
