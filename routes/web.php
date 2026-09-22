<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\LeadController;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () {
    $programs = App\Models\Program::where('is_active', true)->get();
    return view('welcome', compact('programs'));
})->name('home');

Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:5,1')->name('leads.store');

use App\Http\Controllers\ProgramController;

// New Expansion Routes
Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('programs.show');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');
