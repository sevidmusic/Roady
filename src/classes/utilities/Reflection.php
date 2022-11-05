<?php

namespace roady\classes\utilities;

use roady\interfaces\utilities\Reflection as ReflectionInterface;
use roady\interfaces\strings\ClassString;

class Reflection implements ReflectionInterface
{

    public function methodNames(): array
    {
        return [];
    }

    public function methodParameterNames(string $method): array
    {
        return [];
    }

    public function methodParameterTypes(string $method): array
    {
        return [];
    }

    public function propertyNames(): array
    {
        return [];
    }

    public function propertyTypes(): array
    {
        return [];
    }

}

