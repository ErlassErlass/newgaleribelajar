<?php

namespace App\Support;

/**
 * Serves the "<field>_en" column instead of "<field>" when a visitor reads the public site in English.
 *
 * The model lists its translatable columns in $englishFields. Only public pages switch: SetLocale
 * sets config('erlass.content_locale'), the admin panel never does, so admins always see and save the
 * Indonesian original. An empty English column falls back to the Indonesian text.
 */
trait HasEnglishContent
{
    public static function wantsEnglishContent(): bool
    {
        return config('erlass.content_locale') === 'en';
    }

    public function hasEnglish(string $field): bool
    {
        $en = $this->attributes[$field.'_en'] ?? null;

        return is_string($en) && trim($en) !== '';
    }

    public function getAttributeValue($key)
    {
        if (in_array($key, $this->englishFields, true) && static::wantsEnglishContent() && $this->hasEnglish($key)) {
            return $this->attributes[$key.'_en'];
        }

        return parent::getAttributeValue($key);
    }
}
