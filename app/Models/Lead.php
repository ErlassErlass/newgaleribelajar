<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'type',
        'name',
        'phone',
        'email',
        'child_age',
        'program',
        'school_name',
        'message',
    ];
}
