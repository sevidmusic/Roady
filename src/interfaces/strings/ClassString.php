<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\Text;

/**
 * A ClassString is the name of an existing Class prefixed by
 * it's namespace.
 *
 * Methods:
 *
 * ```
 *
 * ```
 *
 * Methods inherited from Text:
 *
 * ```
 * public function __toString(): class-string;
 * public function contains(string|Stringable ...$strings): bool;
 * public function length(): int;
 *
 * ```
 *
 * @example
 *
 * ```
 * echo $classString;
 * // example output: roady\classes\strings\ClassString
 *
 * ```
 *
 * @see Text
 *
 */
interface ClassString extends Text
{

    /**
     * Return the name of an existing Class prefixed by it's
     * namespace.
     *
     * @return class-string
     */
    public function __toString(): string;

}

