<?php

use App\Models\ArticleComment;
use App\Models\Contact;
use App\Models\Lead;
use App\Models\Subscriber;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Rebuild the promotion contact list from data collected before the Contacts feature existed.
// Safe to run again: it rebuilds counts from scratch and never drops consent already given.
Artisan::command('erlass:sync-contacts', function () {
    $consented = Contact::where('marketing_consent', true)->pluck('email')->flip();
    Contact::query()->update(['comment_count' => 0, 'sources' => null]);

    Subscriber::where('is_active', true)->each(fn ($s) => Contact::record($s->email, 'newsletter', ['consent' => true]));
    Lead::whereNotNull('email')->each(fn ($l) => Contact::record($l->email, 'konsultasi', [
        'name' => $l->name, 'phone' => $l->phone, 'consent' => (bool) $l->consent_given,
    ]));
    ArticleComment::query()->orderBy('id')->each(fn ($c) => Contact::record($c->email, 'komentar', [
        'name' => $c->name, 'consent' => (bool) $c->marketing_consent || isset($consented[mb_strtolower($c->email)]),
    ]));

    $this->info(Contact::count().' kontak, '.Contact::where('marketing_consent', true)->count().' bersedia menerima promosi.');
})->purpose('Kumpulkan email dari komentar, newsletter, dan lead ke daftar Kontak Promosi');

// Delete activity log entries older than ActivityLog::RETENTION_DAYS (needs the Laravel scheduler cron on the server)
Schedule::command('model:prune', ['--model' => [\App\Models\ActivityLog::class]])->daily();
