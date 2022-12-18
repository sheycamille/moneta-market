<?php

namespace App\Models;

use App\Models\Country;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wdmethod extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'duration', 'type', 'details', 'country_ids', 'status', 'exchange_symbol', 'setting_key', 'minimum', 'maximum', 'charges_percentage', 'charges_fixed', 'created_at', 'updated_at'
    ];


    public function countries()
    {
        return $this->country_ids? Country::whereIn('id', explode(',', $this->country_ids))->get() : [];
    }
}
