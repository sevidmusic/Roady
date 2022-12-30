<?php

namespace roady\classes\utilities;

use \ReflectionNamedType;
use \ReflectionParameter;
use \ReflectionUnionType;
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
        if(empty($method)) { return []; }
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
        if(empty($method)) { return []; }
        $reflectionClass = $this->reflectionClass;
        $parameterTypes = [];
        foreach(
            $this->reflectionMethod($method)->getParameters()
            as
            $reflectionParameter
        ) {
            $type = $reflectionParameter->getType();
            if(!$type instanceof \ReflectionType) { continue; }
            if($type instanceof ReflectionUnionType) {
                $this->addUnionTypesToArray(
                    $reflectionParameter,
                    $parameterTypes,
                    $type
                );
                continue;
            }
            if($type instanceof ReflectionNamedType) {
                $this->addNamedTypeToArray(
                    $reflectionParameter,
                    $parameterTypes,
                    $type
                );
            }
        }
        return $parameterTypes;
    }

    public function propertyNames(int|null $filter = null): array
    {
        $propertyNames = [];
        foreach(
            $this->reflectionClass->getProperties($filter)
            as
            $reflectionProperty
        ) {
            array_push($propertyNames, $reflectionProperty->getName());
        }
        return $propertyNames;
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

    /**
     * Add an array of strings indicating the types represented by
     * the specified $reflectionUnionType to the specified array of
     * $parameterTypes.
     *
     * If the $reflectionUnionType is nullable, then the string "null"
     * will be included in the array.
     *
     * Index the array by the specified $reflectionParameter's name.
     *
     * @param ReflectionParameter $reflectionParameter
     *                                An instance of a
     *                                ReflectionParameter that
     *                                represents the parameter
     *                                whose types are to be
     *                                represented in the array.
     *
     * @param array<string, array<int, string>> &$parameterTypes
     *                                              The array of
     *                                              parameter types
     *                                              to add the array
     *                                              to.
     *
     * @param ReflectionUnionType $reflectionUnionType
     *                                An instance of a
     *                                ReflectionUnionType
     *                                that represents the
     *                                types expected by the
     *                                parameter whose types
     *                                are to be represented
     *                                in the array.
     * @return void
     *
     * @example
     *
     * ```
     * $this->addUnionTypesToArray(
     *     $reflectionParameter,
     *     $parameterTypes,
     *     $type
     * );
     *
     * ```
     *
     */
    private function addUnionTypesToArray(
        ReflectionParameter $reflectionParameter,
        array &$parameterTypes,
        ReflectionUnionType $reflectionUnionType
    ): void
    {
            $reflectionUnionTypes = $reflectionUnionType->getTypes();
            foreach($reflectionUnionTypes as $unionType) {
                $parameterTypes[$reflectionParameter->getName()][]
                    = $unionType->getName();
            }
            if(
                !in_array(
                    'null',
                    $parameterTypes[$reflectionParameter->getName()]
                )
                &&
                $reflectionUnionType->allowsNull()
            ) {
                $parameterTypes[$reflectionParameter->getName()][]
                    = 'null';
            }
    }


    /**
     * Add an array that contains a string indicating the type
     * represented by the specified $reflectionNamedType to the
     * specified array of $parameterTypes.
     *
     * If the $reflectionNamedType is nullable, then the string
     * "null" will be included in the array.
     *
     * The array will be indexed by the specified
     * $reflectionParameter's name.
     *
     * @param ReflectionParameter $reflectionParameter
     *                                An instance of a
     *                                ReflectionParameter that
     *                                represents the parameter
     *                                whose type is to be
     *                                represented in the array.
     *
     * @param array<string, array<int, string>> &$parameterTypes
     *                                              The array of
     *                                              parameter types
     *                                              to add the array
     *                                              to.
     *
     * @param ReflectionNamedType $reflectionNamedType
     *                                An instance of a
     *                                ReflectionNamedType
     *                                that represents the
     *                                type expected by the
     *                                parameter whose type
     *                                is to be represented
     *                                in the array.
     *
     * @return void
     *
     * @example
     *
     * ```
     * $this->addNamedTypeToArray(
     *     $reflectionParameter,
     *     $parameterTypes,
     *     $reflectionNamedType
     * );
     *
     * ```
     *
     */
    private function addNamedTypeToArray(
        ReflectionParameter $reflectionParameter,
        array &$parameterTypes,
        ReflectionNamedType $reflectionNamedType
    ): void
    {
        $parameterTypes[$reflectionParameter->getName()] =
            [$reflectionNamedType->getName()];
        if($reflectionNamedType->allowsNull()) {
            $parameterTypes[$reflectionParameter->getName()][] =
                'null';
        }
    }

}

