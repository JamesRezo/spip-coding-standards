<?php

namespace Spip\CodingStandards\Strings;

class SnakeCase
{
    public static function isSnakeCase(string $string): bool
    {
        return (bool) preg_match('/^[a-z][a-z0-9]*(?:_[a-z0-9]+)*$/', $string);
    }

    public static function toSnakeCase(string $string): string
    {
        return ltrim(
            mb_strtolower(
                preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $string) ?? ''
            ), '_'
        );
    }
}
