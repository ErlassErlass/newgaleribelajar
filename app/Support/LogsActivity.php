<?php

namespace App\Support;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Records create / update / delete of this model in the activity log, with old → new values.
 * Only actions by a logged-in admin user are logged (seeders, visitors and view counters are not).
 *
 * Optional on the model:
 *  - protected array $activityIgnore = ['field', ...];   extra fields not worth logging
 *  - public function activityLabel(): string               how the record is named in the log
 */
trait LogsActivity
{
    /** Never logged: noise or secrets. */
    private static array $activityAlwaysIgnore = [
        'created_at', 'updated_at', 'remember_token', 'views', 'pinned_at', 'reviewed_at', 'email_verified_at',
    ];

    public static function bootLogsActivity(): void
    {
        static::created(fn (Model $model) => $model->writeActivity('created', $model->activityValues($model->getAttributes())));
        static::updated(fn (Model $model) => $model->writeActivity('updated', $model->activityDiff()));
        static::deleted(fn (Model $model) => $model->writeActivity('deleted', []));
    }

    public function activityLabel(): string
    {
        foreach (['title', 'name', 'question', 'email', 'key', 'slug'] as $attr) {
            if (filled($this->getAttribute($attr))) {
                return Str::limit((string) $this->getAttribute($attr), 120);
            }
        }

        return '#'.$this->getKey();
    }

    protected function writeActivity(string $event, array $changes): void
    {
        if (! auth()->check()) {
            return;
        }
        if ($event === 'updated' && $changes === []) {
            return; // only ignored fields changed (e.g. a view counter)
        }
        ActivityLog::record($event, $this, $changes);
    }

    /** {field: {old, new}} for the fields that really changed. */
    protected function activityDiff(): array
    {
        $diff = [];
        foreach ($this->getChanges() as $field => $new) {
            if ($this->activityIgnores($field)) {
                continue;
            }
            $old = $this->activityDecodeCast($field, $this->getRawOriginal($field));
            $new = $this->activityDecodeCast($field, $new);
            if ($this->activityNormalize($old) === $this->activityNormalize($new)) {
                continue;
            }

            // JSON fields (homepage settings, video list, FAQs...): log only the parts that changed
            $oldArr = self::activityJson($old);
            $newArr = self::activityJson($new);
            if (is_array($oldArr) && is_array($newArr)) {
                $o = \Illuminate\Support\Arr::dot($oldArr);
                $n = \Illuminate\Support\Arr::dot($newArr);
                foreach (array_unique(array_merge(array_keys($o), array_keys($n))) as $path) {
                    if (($o[$path] ?? null) !== ($n[$path] ?? null)) {
                        $diff[$field.'.'.$path] = [
                            'old' => $this->activityValue($field, $o[$path] ?? null),
                            'new' => $this->activityValue($field, $n[$path] ?? null),
                        ];
                    }
                }
                if (count($diff) > 40) {
                    $diff = array_slice($diff, 0, 40, true) + ['…' => ['old' => null, 'new' => 'dan perubahan lain']];
                }

                continue;
            }

            $diff[$field] = ['old' => $this->activityValue($field, $old), 'new' => $this->activityValue($field, $new)];
        }

        return $diff;
    }

    /** Decode a JSON array/object string; anything else returns null. (No json_validate: PHP 8.2 support.) */
    private static function activityJson(mixed $value): ?array
    {
        if (is_array($value)) {
            return $value;
        }
        if (! is_string($value) || ! in_array($value[0] ?? '', ['[', '{'], true)) {
            return null;
        }
        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE && is_array($decoded) ? $decoded : null;
    }

    /** Initial values of a new record, as {field: {old: null, new}}. */
    protected function activityValues(array $attributes): array
    {
        $out = [];
        foreach ($attributes as $field => $value) {
            if ($this->activityIgnores($field) || $field === $this->getKeyName() || $value === null || $value === '') {
                continue;
            }
            $out[$field] = ['old' => null, 'new' => $this->activityValue($field, $this->activityDecodeCast($field, $value))];
        }

        return $out;
    }

    private function activityIgnores(string $field): bool
    {
        return in_array($field, self::$activityAlwaysIgnore, true)
            || in_array($field, $this->activityIgnore ?? [], true);
    }

    private function activityNormalize(mixed $value): string
    {
        $arr = self::activityJson($value);

        return $arr !== null ? json_encode($arr) : (string) $value;
    }

    /** JSON-cast columns hold encoded text in the raw attributes (e.g. "\"https://...\""); decode for the log. */
    private function activityDecodeCast(string $field, mixed $value): mixed
    {
        if (is_string($value) && $this->hasCast($field, ['json', 'array', 'object', 'collection'])) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return $value;
    }

    /** Readable, size-limited value for the log. */
    private function activityValue(string $field, mixed $value): mixed
    {
        if ($field === 'password') {
            return '••••• (diganti)';
        }
        $value = self::activityJson($value) ?? $value;
        if (is_array($value)) {
            $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            return mb_strlen($json) > 600 ? mb_substr($json, 0, 600).'… ('.mb_strlen($json).' karakter)' : $value;
        }
        if (is_string($value) && mb_strlen($value) > 300) {
            return mb_substr($value, 0, 300).'… ('.mb_strlen($value).' karakter)';
        }

        return $value;
    }
}
