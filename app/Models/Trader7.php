<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Trader7 extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'number', 'name', 'type', 'options', 'leverage', 'balance', 'bonus', 'credit', 'status', 'client_sort', 'created_at', 'updated_at', 'currency', 'currency_id', 'swap_type', 'loyalty', 'is_cheater'];

    protected $casts = [
        'id' => 'integer',
        'number' => 'integer'
      ];

    public function tuser()
    {
        return $this->belongsTo('App\Models\User', 'client_id');
    }
}