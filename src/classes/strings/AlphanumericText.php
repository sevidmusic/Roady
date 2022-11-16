<?php

namespace roady\classes\strings;

use roady\interfaces\strings\AlphanumericText as AlphanumericTextInterface;
use roady\classes\strings\SafeText;
use roady\interfaces\strings\Text as TextInterface;
use roady\classes\strings\Text;

class AlphanumericText extends SafeText implements AlphanumericTextInterface
{

    /**
     * Modify a string, insuring only alphanumeric characters
     * exist in the resulting string:
     *
     * If the original string is empty, then the modified string will
     * be the numeric character 0.
     *
     * If the original string does not contain any alphanumeric
     * characters, then the modified string will be the numeric
     * character 0.
     *
     * Also, the first letter of each alphanumeric word in the
     * original string will be capitalized in the resulting string.
     *
     * @return string
     *
     * @example
     *
     * ```
     * $string = '!Foo Bar Baz..Bin!@#Bar--foo____%$#@#$%^&*bazzer';
     *
     * echo $this->makeStringSafe($string);
     * // example output: FooBarBazBinBarFooBazzer
     *
     * $string = '';
     *
     * echo $this->makeStringSafe($string);
     * // example output: 0
     *
     * ```
     *
     */
    protected function makeStringSafe(string $string): string
    {
        $safeString = parent::makeStringSafe($string);
        $words = ucwords($safeString, '_-.');
        $alphanumericString = preg_replace(
            "/[^A-Za-z0-9 ]/",
            '',
            $words
        );
        return strval(
            empty($alphanumericString)
            ? 0
            : $alphanumericString
        );
    }

}

