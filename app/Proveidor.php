<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveidor extends Model
{
    //
    protected $fillable = [
        'name', 'city', 'speciality'
    ];
}
