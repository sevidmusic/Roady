<?php

namespace roady\interfaces\strings;

use \Stringable;

/**
 * Text represents a string, can be cast to the string it represents,
 * and can provide information about the string it represents.
 *
 * @example
 *
 * ```
 * echo $text;
 * // example output: Foo
 *
 * echo (string->contains('F', 'oo', $text) ? 'true' : 'false');
 * // example output: true
 *
 * echo (string->contains('f', 'oo', $text) ? 'true' : 'false');
 * // example output: false
 *
 * echo strval($text->length());
 * // example output: 3
 *
 * ```
 *
 * @see Stringable
 *
 */
interface Text extends Stringable
{

    /**
     * Return the string this Text represents.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $text->__toString();
     * // example output: Foo Bar Baz
     *
     * ```
     *
     */
    public function __toString(): string;

    /**
     * Return true if the Text contains all of the specified strings,
     * false otherwise.
     *
     * @param string|Stringable $strings The strings to search for.
     *
     * @return bool
     *
     * @example
     *
     * ```
     * echo $text;
     * // example output: Foo
     *
     * echo (string->contains('F', 'oo', $text) ? 'true' : 'false');
     * // example output: true
     *
     * echo (string->contains('f', 'oo', $text) ? 'true' : 'false');
     * // example output: false
     *
     * ```
     *
     * @see Stringable
     *
     */
    public function contains(string|Stringable ...$strings): bool;

    /**
     * Return the Text's length as an integer.
     *
     * @return int
     *
     * @example
     *
     * ```
     * echo $text;
     * // example output: Foo
     *
     * echo strval($text->length());
     * // example output: 3
     *
     * ```
     *
     */
    public function length(): int;

}

