<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /** Languages the public site offers (see the ID / EN switcher in the header). */
    public const LOCALES = ['id', 'en'];

    /** Shown until a visitor picks a language. Indonesian on purpose, independent of APP_LOCALE in .env. */
    public const DEFAULT = 'id';

    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale');
        $locale = in_array($locale, self::LOCALES, true) ? $locale : self::DEFAULT;
        App::setLocale($locale);
        // Tells HasEnglishContent models (products, articles) which version of their text to show.
        // Only public routes run this middleware, so the admin panel keeps editing the Indonesian original.
        config(['erlass.content_locale' => $locale]);

        return $next($request);
    }
}
