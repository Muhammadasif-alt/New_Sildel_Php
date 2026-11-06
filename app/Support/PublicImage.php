<?php

namespace App\Support;

/**
 * Small helper for images stored under /public: existence check and intrinsic
 * dimensions (used for width/height attributes to avoid layout shift).
 */
final class PublicImage
{
    /** @var array<string, array{0: int, 1: int}|null> */
    private static array $sizes = [];

    public static function exists(?string $path): bool
    {
        return $path !== null && $path !== '' && is_file(public_path($path));
    }

    /** @return array{0: int, 1: int}|null */
    public static function size(string $path): ?array
    {
        if (! array_key_exists($path, self::$sizes)) {
            $info = self::exists($path) ? @getimagesize(public_path($path)) : false;
            self::$sizes[$path] = $info ? [$info[0], $info[1]] : null;
        }

        return self::$sizes[$path];
    }
}
