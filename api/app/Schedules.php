<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $fillable = [
        'name', 
        'phone',
        'email',
        'birth_date',
        'address'
    ];
}
