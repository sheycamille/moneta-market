<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;


    public function getContent($ref_key, $prop)
    {
        $content = Content::where('ref_key', $ref_key)->first();
        return $content->$prop;
    }


    public function getImage($ref_key, $prop)
    {
        $images = Images::where('ref_key', $ref_key)->first();
        return $images->$prop;
    }
}