<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use \App\Support\FlushesSiteCache;

    protected $guarded = [];
}
