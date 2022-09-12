<?php

namespace roady\classes\strings;

use roady\classes\strings\Text;
use roady\interfaces\strings\ClassString as ClassStringInterface;
use roady\interfaces\strings\Text as TextInterface;

class ClassString extends Text implements ClassStringInterface
{

    public function __construct(object|string $classString)
    {
        parent::__construct($this->getClass($classString));
    }

    private function getClass(object|string $classString): string
    {
        $classString = (
            is_object($classString) ?
            get_class($classString) :
            $classString
        );
        return (
            class_exists($classString)
            ? $classString
            : get_class($this)
        );
    }

}

