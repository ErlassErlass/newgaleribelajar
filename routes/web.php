<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProgramController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Program;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () {
    $categories = Category::where('is_active', true)
        ->orderBy('sort_order')
        ->with(['products' => function ($q) {
            $q->where('status', 'published')->orderBy('sort_order');
        }])
        ->get();

    $featuredProducts = Product::with('category')
        ->where('is_featured', true)
        ->where('status', 'published')
        ->orderBy('sort_order')
        ->take(8)
        ->get();

    $partners = Partner::where('is_featured', true)
        ->orderBy('sort_order')
        ->get();

    $allPartnerSchools = Partner::where('type', 'school')
        ->orderByDesc('total_deals')
        ->take(40)
        ->get();

    $totalSchools = Partner::count();
    $totalDeals = Partner::sum('total_deals');

    $programs = Program::where('is_active', true)->get();

    return view('welcome', compact(
        'categories',
        'featuredProducts',
        'partners',
        'allPartnerSchools',
        'totalSchools',
        'totalDeals',
        'programs'
    ));
})->name('home');

Route::post('/leads', [LeadController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('leads.store');

Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('programs.show');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');
