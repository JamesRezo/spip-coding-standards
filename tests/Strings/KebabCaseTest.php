<?php

namespace Spip\CodingStandards\Test\Strings;

use PHPUnit\Framework\TestCase;
use Spip\CodingStandards\Strings\KebabCase;

/**
 * @covers Spip\CodingStandards\Strings\KebabCase
 */
class KebabCaseTest extends TestCase
{
    public function dataIsKebabCase()
    {
        return [
            'empty string' => [
                false,
                '',
            ],
            'underscore starting string' => [
                false,
                '_kebab_case',
            ],
            'underscore ending string' => [
                false,
                'kebab_case_',
            ],
            'uppercase string' => [
                false,
                'NotKebabCase',
            ],
            'minimal kebab_case string' => [
                true,
                's-c',
            ],
            'kebab_case string' => [
                true,
                'kebab-case',
            ],
        ];
    }

    /**
     * @dataProvider dataIsKebabCase
     */
    public function testIsKebabCase($expected, $string)
    {
        $this->assertSame($expected, KebabCase::isKebabCase($string));
    }

    public function dataToKebabCase()
    {
        return [
            'PascalCase' => [
                'kebab-case',
                'KebabCase',
            ],
            'camelCase' => [
                'kebab-case',
                'kebabCase',
            ],
            'UPPERCASE' => [
                'kebabcase',
                'KEBABCASE',
            ],
            'kebab-withmiddle-case' => [
                'weird-kebab-case',
                'WeirdKEBABCase',
            ],
            'BringAKebab' => [
                'bring-a-kebab',
                'BringAKebab',
            ],
        ];
    }

    /**
     * @dataProvider dataToKebabCase
     */
    public function testToKebabCase($expected, $string)
    {
        $this->assertSame($expected, KebabCase::toKebabCase($string));
    }
}
