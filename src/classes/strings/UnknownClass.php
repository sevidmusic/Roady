<?php

namespace roady\classes\strings;

use roady\interfaces\strings\UnknownClass as UnknownClassInterface;

use roady\classes\strings\ClassString;

final class UnknownClass extends ClassString implements UnknownClassInterface
{

    /**
     * Instantiate a new UnknownClass instance.
     *
     * @example
     *
     * ```
     * $text = new UnknownClass();
     *
     * echo $unknownClass;
     * // example output: roady\classes\strings\UnknownClass
     *
     * ```
     *
     */
    public function __construct()
    {
        parent::__construct(get_class($this));
    }

}

