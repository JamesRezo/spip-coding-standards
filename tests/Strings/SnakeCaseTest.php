<?php

namespace Spip\CodingStandards\Test\Strings;

use PHPUnit\Framework\TestCase;
use Spip\CodingStandards\Strings\SnakeCase;

/**
 * @covers Spip\CodingStandards\Strings\SnakeCase
 */
class SnakeCaseTest extends TestCase
{
    public function dataIsSnakeCase()
    {
        return [
            'empty string' => [
                false,
                '',
            ],
            'underscore starting string' => [
                false,
                '_snake_case',
            ],
            'underscore ending string' => [
                false,
                'snake_case_',
            ],
            'underscore ending string 2' => [
                false,
                's_',
            ],
            'uppercase string' => [
                false,
                'NotSnakeCase',
            ],
            'minimal snake_case string' => [
                true,
                's_c',
            ],
            'minimal snake_case string with uppercase' => [
                false,
                's_C',
            ],
            'snake_case string' => [
                true,
                'snake_case',
            ],
            'one character string' => [
                true,
                's',
            ]
        ];
    }

    /**
     * @dataProvider dataIsSnakeCase
     */
    public function testIsSnakeCase($expected, $string)
    {
        $this->assertSame($expected, SnakeCase::isSnakeCase($string));
    }

    public function dataToSnakeCase()
    {
        return [
            'PascalCase' => [
                'snake_case',
                'SnakeCase',
            ],
            'camelCase' => [
                'snake_case',
                'snakeCase',
            ],
            'UPPERCASE' => [
                'snakecase',
                'SNAKECASE',
            ],
            'snake_withmiddle_case' => [
                'weird_snake_case',
                'WeirdSNAKECase',
            ],
            'BringASnake' => [
                'bring_a_snake',
                'BringASnake',
            ],
        ];
    }

    /**
     * @dataProvider dataToSnakeCase
     */
    public function testToSnakeCase($expected, $string)
    {
        $this->assertSame($expected, SnakeCase::toSnakeCase($string));
    }
}
