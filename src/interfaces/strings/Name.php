<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\SafeText;

/**
 * A Name is SafeText that begins with an alphanumeric character,
 * is at least 1 character in length, is no more than 70 characters
 * in length, and only contains the following characters:
 *
 * - Alphanumeric characters: A-Z, a-z, and 0-9
 * - Underscores: _
 * - Hyphens: -
 * - Periods: .
 *
 * @example
 *
 * ```
 * echo $name;
 * // example output: Foo_Bar_Baz.Bin_Bar-Foo_Bazzer
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
     * is at least 1 character in length, is no more than 70
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
     * echo $name->__toString();
     * // example output: _Foo_Bar_Baz.Bin_Bar-Foo_
     *
     * ```
     *
     */
    public function __toString(): string;

}

