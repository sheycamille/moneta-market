<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cost', 'min_deposit', 'max_leverage', 'min_trade_size', 'max_trade_size', 'swaps', 'fx_commission', 'num_fx_pairs', 'num_commodities_pairs', 'num_indices_pairs', 'trading_platforms', 'typical_spread', 'execution_type', 'requotes', 'available_instruments', 'educational_material', 'active',
    ];
}