<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value',
    ];

    public static function getValue($name)
    {
        $setting = Setting::where('name', $name)->first();
        return $setting->value ?? '';
    }


    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }
}
