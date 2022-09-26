<?php

namespace roady\classes\strings;

use roady\interfaces\strings\UnknownClass as UnknownClassInterface;

use roady\classes\strings\ClassString;

final class UnknownClass extends ClassString implements UnknownClassInterface
{

    public function __construct()
    {
        parent::__construct(get_class($this));
    }

}

