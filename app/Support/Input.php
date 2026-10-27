<?php

namespace App\Support;

/**
 * Helper kecil untuk input dari query string/form.
 */
class Input
{
    /** Ambil query string sebagai teks pendek; array (?q[]=..) dan nilai aneh dianggap kosong. */
    public static function text(mixed $value, int $max = 100): ?string
    {
        if (! is_string($value)) {
            return null;
        }
        $value = trim(mb_substr($value, 0, $max));

        return $value === '' ? null : $value;
    }

    /** Pola LIKE "mengandung" dengan wildcard % _ \ di-escape, supaya input dicari apa adanya. */
    public static function like(string $term): string
    {
        return '%'.addcslashes($term, '\\%_').'%';
    }

    /** Buang tag HTML dari field teks bebas sebelum disimpan. */
    public static function clean(mixed $value): mixed
    {
        return is_string($value) ? trim(strip_tags($value)) : $value;
    }
}
