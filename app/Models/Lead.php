<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'type',
        'sender_type',
        'name',
        'phone',
        'email',
        'child_age',
        'program',
        'school_name',
        'city',
        'student_count',
        'message',
        'consent_given',
        'status',
        'source',
    ];

    protected $casts = [
        'student_count' => 'integer',
        'consent_given' => 'boolean',
    ];
}
