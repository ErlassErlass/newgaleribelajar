<?php

namespace App\Providers;

use App\Models\ActivityLog;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Indonesian dates site-wide ("2 jam yang lalu", "24 November 2026")
        \Carbon\Carbon::setLocale('id');

        // Settings edited in the admin panel (Shopee link, WhatsApp, videos...) override config/erlass.php
        Setting::applyToConfig();

        // Activity log: admin panel logins, failed attempts and logouts
        Event::listen(Login::class, fn (Login $e) => $e->user instanceof User
            ? ActivityLog::record('login', null, [], null, $e->user) : null);
        Event::listen(Logout::class, fn (Logout $e) => $e->user instanceof User
            ? ActivityLog::record('logout', null, [], null, $e->user) : null);
        Event::listen(Failed::class, fn (Failed $e) => ActivityLog::record(
            'login_failed', null, [], 'Percobaan login dengan email: '.mb_substr((string) ($e->credentials['email'] ?? '-'), 0, 120),
            $e->user instanceof User ? $e->user : null
        ));
    }
}
