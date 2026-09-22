<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Program;

class ProgramController extends Controller
{
    public function show($slug)
    {
        $program = Program::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        return view('programs.show', compact('program'));
    }
}
