<?php

namespace Spip\CodingStandards\Strings;

class KebabCase
{
    public static function isKebabCase(string $string): bool
    {
        return (bool) preg_match('/^[a-z][a-z0-9]*(?:-[a-z0-9]+)*$/', $string);
    }

    public static function toKebabCase(string $string): string
    {
        return ltrim(
            mb_strtolower(
                preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '-$0', $string) ?? ''
            ), '-'
        );
    }
}
