<?php

namespace roady\interfaces\strings;

use roady\interfaces\strings\AlphanumericText;

/**
 * An Id is AlphanumericText whose length is between 60
 * and 80 characters.
 *
 * @example
 *
 * ```
 * echo $id;
 * // example output:
 * // c3960334647973d3d753f49291c0a3bd4491f51c347368d8f237631673f38341
 *
 * echo strval($id->length());
 * // example output:
 * // 64
 *
 * ```
 */
interface Id extends AlphanumericText
{

    /**
     * Return an alphanumeric string that is between 60 and 80
     * characters in length.
     *
     * @return string
     *
     * @example
     *
     * ```
     * echo $id->__toString();
     * // example output:
     * // 7694393f478adc733111936440230652c769f431bd5333d34878f13f374d
     *
     * echo strval($id->length());
     * // example output:
     * // 60
     *
     * ```
     *
     */
    public function __toString(): string;

}

