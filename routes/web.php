<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\LlmsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\HomeController;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, \App\Http\Middleware\SetLocale::LOCALES, true)) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', HomeController::class)->name('home');

Route::post('/leads', [LeadController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('leads.store');

Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('programs.show');

Route::get('/gallery', GalleryController::class)->name('gallery');

Route::get('/lms', \App\Http\Controllers\LmsController::class)->name('lms.index');

Route::view('/kebijakan-privasi', 'legal.privacy')->name('privacy');
Route::view('/syarat-ketentuan', 'legal.terms')->name('terms');

Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/artikel/{slug}/komentar', [ArticleCommentController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('articles.comments.store');

Route::post('/berlangganan', [SubscriberController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('subscribe.store');

// Product catalog
Route::get('/katalog', [ProductController::class, 'index'])->name('products.index');
Route::get('/katalog/cover/{sku}.svg', [ProductController::class, 'cover'])
    ->where('sku', '[A-Za-z0-9\-]+')
    ->name('products.cover');
Route::get('/katalog/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
// GEO: plain-text site summary for AI assistants (llmstxt.org)
Route::get('/llms.txt', LlmsController::class)->name('llms');
