<?php

namespace roady\classes\strings;

use roady\classes\strings\SafeText;
use roady\interfaces\strings\Name as NameInterface;

class Name extends SafeText implements NameInterface
{

    /**
     * Modify a string, insuring only the following characters
     * exist in the resulting string:
     *
     * - Alphanumeric characters: A-Z, a-z, and 0-9
     * - Underscores: _
     * - Hyphens: -
     * - Periods: .
     *
     * Unsafe characters will be replaced with underscores.
     *
     * A consecutive sequence of 2 or more unsafe characters will be
     * replaced by a single underscore.
     *
     * A consecutive sequence of 2 or more underscores will be
     * replaced by a single underscore.
     *
     * A consecutive sequence of 2 or more hyphens will be replaced by
     * a single hyphen.
     *
     * A consecutive sequence of 2 or more periods will be replaced by
     * a single period.
     *
     * If the original string is empty, then the modified string will
     * be the numeric character: 0
     *
     * Finally, the resulting string will always start with an
     * alphanumeric character.
     *
     * If the original string does not contain any alphanumeric
     * characters than the modified string will be the numeric
     * character: 0
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = '!Foo Bar Baz..Bin!@#Bar--Foo____%$#@#$%^&*Bazzer';
     *
     * echo $this->makeStringSafe($string);
     * // example output: Foo_Bar_Baz.Bin_Bar-Foo_Bazzer
     *
     * $string = '';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '_';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '-';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '.';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * $string = '(#$*%*';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * ```
     *
     */
    protected function makeStringSafe(string $string): string
    {
        $string = parent::makeStringSafe($string);
        $string = substr(
            $string,
            $this->positionOfFirstAlphanumericCharacter($string),
            70
        );
        return match(
            empty($string) ||
            $string === '_' ||
            $string === '-' ||
            $string === '.'
        ) {
            true => strval(0),
            default => $string
        };
    }

    /**
     * Determine the position of the first alphanumeric character
     * in a string.
     *
     * @return int
     *
     * @example
     *
     * ```
     * echo strval(
     *     $this->positionOfFirstAlphanumericCharacter('_A_B_C')
     * );
     * // example output: 1
     *
     * ```
     *
     */
    private function positionOfFirstAlphanumericCharacter(
        string $string
    ): int
    {
        $stringLength = mb_strlen($string);
        for(
            $firstAlphanumericCharacterIndex = 0;
            $firstAlphanumericCharacterIndex < $stringLength;
            $firstAlphanumericCharacterIndex++
        ) {
            if (
                ctype_alnum(
                    $string[$firstAlphanumericCharacterIndex]
                )
            ) {
                break;
            };
        }
        return $firstAlphanumericCharacterIndex;
    }

}

