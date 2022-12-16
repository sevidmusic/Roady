<?php

namespace roady\classes\utilities;

use \ReflectionClass;
use \ReflectionMethod;
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
     *                                     The Reflection will
     *                                     provide information
     *                                     about the class or
     *                                     object instance
     *                                     reflected by the
     *                                     specified ReflectionClass.
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
            array_push($methodNames, $reflectionMethod->getName());
        }
        return $methodNames;
    }

    public function methodParameterNames(string $method): array
    {
        $parameterNames = [];
        foreach(
            $this->reflectionMethod($method)->getParameters()
            as
            $reflectionParameter
        ) {
            array_push(
                $parameterNames,
                $reflectionParameter->getName()
            );
        }
        return $parameterNames;
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

    public function propertyValues(): array
    {
        return [];
    }

    public function type(): ClassStringInterface
    {
        return new ClassString(
            $this->reflectionClass->getName()
        );
    }

    /**
     * Return an instance of a ReflectionMethod for the specified
     * method of the reflected class or object instance.
     *
     * @param string $method The name of the method to be reflected
     *                       by the returned ReflectionMethod
     *                       instance.
     *
     * @return ReflectionMethod
     *
     * @example
     *
     * ```
     * $this->reflectionMethod('methodName');
     *
     * ```
     *
     */
    final protected function reflectionMethod(
        string $method
    ): ReflectionMethod
    {
        return new ReflectionMethod(
            $this->type()->__toString(),
            $method
        );
    }
}

