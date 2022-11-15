<?php

namespace roady\classes\utilities;

use \ReflectionClass;
use roady\classes\strings\ClassString;
use roady\interfaces\strings\ClassString as ClassStringInterface;
use roady\interfaces\utilities\Reflection as ReflectionInterface;

class Reflection implements ReflectionInterface
{

    /**
     * Instantiate a new Reflection of the class or object instance
     * reflected by the specified ReflectionClass instance.
     *
     * @param ReflectionClass <object> $reflectionClass
     *
     *                                     An instance of a
     *                                     ReflectionClass.
     *
     *                                     The Reflection will provide
     *                                     information about the class
     *                                     or object instance
     *                                     reflected by the specified
     *                                     ReflectionClass.
     *
     * @example
     *
     * ```
     * $reflection = new \roady\classes\utilities\Reflection(
     *                   new \ReflectionClass(
     *                       \roady\classes\strings\Id::class
     *                   )
     *               );
     *
     * ```
     *
     */
    public function __construct(
        private ReflectionClass $reflectionClass
    ) {}

    public function methodNames(int|null $filter = null): array
    {
        $methodNames = [];
        foreach(
            $this->reflectionClass->getMethods($filter)
            as
            $reflectionMethod
        ) {
            array_push($methodNames, $reflectionMethod->name);
        }
        return $methodNames;
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

    public function type(): ClassStringInterface
    {
        return new ClassString(
            $this->reflectionClass->getName()
        );
    }

}

