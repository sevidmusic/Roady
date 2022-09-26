<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\ClassString;

/**
 * An UnknownClass is a ClassString that represents an unknown class.
 *
 * Methods:
 *
 * ```
 *
 * ```
 *
 * Methods inherited from ClassString:
 *
 * ```
 * public function __toString(): class-string;
 * public function contains(string|Stringable ...$strings): bool;
 * public function length(): int;
 *
 *
 * ```
 *
 * @example
 *
 * ```
 * echo $unknownClass;
 * // example output: roady\classes\strings\UnknownClass
 *
 * ```
 */
interface UnknownClass extends ClassString
{

}

