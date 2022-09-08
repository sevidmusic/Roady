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
     * At the moment the Name interface does not define any
     * unique methods.
     *
     * This may change in the future.
     *
     * For now, this interface just functions as a namespace.
     *
     */

}

