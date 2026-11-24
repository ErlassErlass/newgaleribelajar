<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use \App\Support\FlushesSiteCache;

    protected $guarded = [];
}
