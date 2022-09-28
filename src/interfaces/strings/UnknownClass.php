<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\ClassString;

/**
 * An UnknownClass is a ClassString that represents an unknown class.
 *
 * @example
 *
 * ```
 * echo $unknownClass;
 * // example output: roady\classes\strings\UnknownClass
 *
 * ```
 *
 * @see ClassString
 *
 */
interface UnknownClass extends ClassString
{

    /**
     * Return roady\classes\strings\UnknownClass
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $unknownClass->__toString();
     * // example output: roady\classes\strings\UnknownClass
     *
     * ```
     *
     */
    public function __toString(): string;

}

