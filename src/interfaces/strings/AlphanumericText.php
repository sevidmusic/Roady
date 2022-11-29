<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\SafeText;

/**
 * AlphanumericText is SafeText that only contains alphanumeric
 * characters.
 *
 * @example
 *
 * ```
 * echo $alphanumericText->originalText();
 * // example output: Foo_Bar baz-bazzer
 *
 * echo $alphanumericText;
 * // example output: FooBarbazbazzer
 *
 * ```
 */
interface AlphanumericText extends SafeText
{

    /**
     * Return the alphanumeric form of the original Text as a string.
     *
     * If the original Text is empty, then the AlphanumericText will
     * be the numeric character 0.
     *
     * If the original Text does not contain any alphanumeric
     * characters, then the AlphanumericText will be the numeric
     * character 0.
     *
     * Also, the first letter of each alphanumeric word in the
     * original Text will be capitalized in the AlphanumericText.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $alphanumericText->originalText();
     * // example output: !Foo bar Baz..Bin!@#bar--foo____%$#@#$%^&*
     *
     * echo $alphanumericText;
     * // example output: FooBarBazBinBarFoo
     *
     * echo $alphanumericText->originalText();
     * // example output:
     *
     * echo $alphanumericText;
     * // example output: 0
     *
     * ```
     *
     */
    public function __toString(): string;

}

