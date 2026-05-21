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
    return view('welcome');
})->name('home');

Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');

// New Expansion Routes
Route::get('/programs/coding', function () {
    return view('programs.coding');
})->name('programs.coding');

Route::get('/programs/robotics', function () {
    return view('programs.robotics');
})->name('programs.robotics');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');
