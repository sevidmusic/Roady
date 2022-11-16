<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\SafeText;

/**
 * A Name is SafeText that begins with an alphanumeric character,
 * is at least one character in length, and is no more than 70
 * characters in length.
 *
 * If a Name's length is 1, than the one character must be an
 * alphanumeric character since all Names must begin with an
 * alphanumeric character.
 *
 * If a Name's original Text does not contain any alphanumeric
 * characters, than the Name will be the numeric character: 0
 *
 * @example
 *
 * ```
 * echo $name->originalText();
 * // example output: !Foo Bar Baz..Bin!@#Bar--Foo____%$#@#$%^&*Bazzer
 *
 * echo $name;
 * // example output: Foo_Bar_Baz.Bin_Bar-Foo_Bazzer
 *
 * echo $name->originalText();
 * // example output:
 *
 * echo $name;
 * // example output: 0
 *
 * echo $name->originalText();
 * // example output: A
 *
 * echo $name;
 * // example output: A
 *
 * echo $name->originalText();
 * // example output:  _
 *
 * echo $name;
 * // example output: 0
 *
 * echo $name->originalText();
 * // example output:  -
 *
 * echo $name;
 * // example output: 0
 *
 * echo $name->originalText();
 * // example output:  .
 *
 * echo $name;
 * // example output: 0
 *
 * echo $name->originalText();
 * // example output: (#$*%*
 *
 * echo $name;
 * // example output: 0
 *
 * ```
 *
 * @see SafeText
 *
 */
interface Name extends SafeText
{

    /**
     * Return a string that begins with an alphanumeric character,
     * is at least one character in length, is no more than 70
     * characters in length, and only contains the following
     * characters:
     *
     * - Alphanumeric characters: A-Z, a-z, and 0-9
     * - Underscores: _
     * - Hyphens: -
     * - Periods: .
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $name->originalText()->__toString();
     * // example output: !Foo Bar Baz..Bin!@#Bar--Foo____%$#@#$%^&*
     *
     * echo $name->__toString();
     * // example output: _Foo_Bar_Baz.Bin_Bar-Foo_
     *
     * ```
     *
     */
    public function __toString(): string;

}

