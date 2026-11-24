<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Email list for the promotion team, built from comments, newsletter sign-ups and consultation leads. */
class Contact extends Model
{
    use \App\Support\LogsActivity;

    protected $guarded = [];

    protected $casts = [
        'sources' => 'array',
        'marketing_consent' => 'boolean',
        'first_seen_at' => 'datetime',
        'last_seen_at' => 'datetime',
    ];

    public const SOURCES = [
        'komentar' => 'Komentar Artikel',
        'newsletter' => 'Newsletter',
        'konsultasi' => 'Form Konsultasi',
    ];

    /**
     * Upsert a contact. Consent is sticky: once given it stays true until an admin removes it.
     */
    public static function record(?string $email, string $source, array $data = []): ?self
    {
        $email = mb_strtolower(trim((string) $email));
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        }

        $contact = self::firstOrNew(['email' => $email]);
        $contact->name = $data['name'] ?? $contact->name;
        $contact->phone = $data['phone'] ?? $contact->phone;
        $contact->sources = array_values(array_unique(array_merge($contact->sources ?? [], [$source])));
        $contact->marketing_consent = $contact->marketing_consent || ! empty($data['consent']);
        if ($source === 'komentar') {
            $contact->comment_count = ($contact->comment_count ?? 0) + 1;
        }
        $contact->first_seen_at ??= now();
        $contact->last_seen_at = now();
        $contact->save();

        return $contact;
    }
}
