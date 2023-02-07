<?php

namespace roady\classes\utilities;

use \ReflectionClass;
use \ReflectionMethod;
use \ReflectionNamedType;
use \ReflectionParameter;
use \ReflectionProperty;
use \ReflectionUnionType;
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
     *                                               An instance of a
     *                                               ReflectionClass.
     *
     * @example
     *
     * ```
     * $reflection = new \roady\classes\utilities\Reflection(
     *                   new \ReflectionClass(\stdClass::class)
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
            $this->reflectionClass()->getMethods($filter)
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
            $this->reflectionClass()->getProperties($filter)
            as
            $reflectionProperty
        ) {
            array_push($propertyNames, $reflectionProperty->getName());
        }
        $this->addParentPropertyNamesToArray(
            $this->reflectionClass(),
            $propertyNames,
            $filter
        );
        $propertyNames = array_unique($propertyNames);
        return $propertyNames;
    }

    public function propertyTypes(int $filter = null): array
    {
        $reflectionClass = $this->reflectionClass();
        $propertyTypes = [];
        foreach(
            $reflectionClass->getProperties($filter)
            as
            $reflectionProperty
        ) {
            $type = $reflectionProperty->getType();
            if(!$type instanceof \ReflectionType) { continue; }
            if($type instanceof ReflectionUnionType) {
                $this->addUnionTypesToArray(
                    $reflectionProperty,
                    $propertyTypes,
                    $type
                );
                continue;
            }
            if($type instanceof ReflectionNamedType) {
                $this->addNamedTypeToArray(
                    $reflectionProperty,
                    $propertyTypes,
                    $type
                );
            }
        }
        $this->addParentPropertyTypesToArray(
            $this->reflectionClass(),
            $propertyTypes,
            $filter
        );
        return $propertyTypes;
    }

    public function type(): ClassStringInterface
    {
        return new ClassString(
            $this->reflectionClass()->getName()
        );
    }

    /**
     * For each property declared by the parents of the reflected
     * class or object instance add a numerically indexed array of
     * strings that indicate the types accepted by the property
     * to the specified array of $propertyTypes.
     *
     * @param ReflectionClass <object> $reflectionClass
     *                                     An instance of a
     *                                     ReflectionClass that
     *                                     reflects the class or
     *                                     object instance that
     *                                     is to have arrays of
     *                                     strings indicating the
     *                                     types accepted by each
     *                                     property declared by
     *                                     it's parents added to
     *                                     the specified array of
     *                                     $propertyTypes.
     *
     * @param array<string, array<int, string>> &$propertyTypes The
     *                                                          array
     *                                                          to add
     *                                                          the
     *                                                          arrays
     *                                                          to.
     *
     * @param int|null $filter Determine what properties have an
     *                         array of strings indicating their
     *                         accepted types added to the specified
     *                         array of $propertyTypes based on the
     *                         following filters:
     *
     *                         Reflection::IS_FINAL
     *                         Reflection::IS_PRIVATE
     *                         Reflection::IS_PROTECTED
     *                         Reflection::IS_PUBLIC
     *                         Reflection::IS_STATIC
     *
     *                         An array of strings indicating a
     *                         property's accepted types will be
     *                         added to the specified array of
     *                         $propertyTypes for each property
     *                         declared by the parents of the
     *                         reflected class or object instance
     *                         that meets the expectation of the
     *                         given filters.
     *
     *                         If no filters are specified, then
     *                         an array of strings indicating a
     *                         property's accepted types will be
     *                         added to the specified array of
     *                         $propertyTypes for each property
     *                         declared by the parents of the
     *                         reflected class or object instance.
     *
     *                         Note: Note that some bitwise
     *                         operations will not work with
     *                         these filters. For instance a
     *                         bitwise NOT (~), will not work
     *                         as expected. For example, it is
     *                         not possible to target all non-static
     *                         properties via a call like:
     *
     *                         ```
     *
     *                         $propertyNames = [];
     *                         $this->addParentPropertyTypesToArray(
     *                             $this->reflectionClass(),
     *                             $propertyTypes,
     *                             ~Reflection::IS_STATIC
     *                         );
     *
     *                         ```
     *
     * @return void
     *
     * @example
     *
     * ```
     * var_dump($reflection->type());
     *
     * // example output:
     * object(roady\classes\strings\ClassString)#13 (1) {
     *   ["string":"roady\classes\strings\Text":private]=>
     *   string(73) "tests\dev\mock\classes\ClassDExtendsClassCInheirtsFromClassBAndFromClassA"
     * }
     *
     * $propertyTypes = [];
     *
     * $reflection->addParentPropertyTypesToArray(
     *     $this->reflectionClass(),
     *     $propertyTypes,
     *     Reflection::IS_PRIVATE
     * );
     *
     * var_dump($propertyTypes);
     *
     * array(8) {
     *   ["classCExtendsClassBInheirtsFromClassAPrivateProperty"]=>
     *   array(1) {
     *     [0]=>
     *     string(4) "bool"
     *   }
     *   ["classCExtendsClassBInheirtsFromClassAPrivateStaticProperty"]=>
     *   array(1) {
     *     [0]=>
     *     string(4) "bool"
     *   }
     *   ["privatePropertySharedName"]=>
     *   array(3) {
     *     [0]=>
     *     string(4) "bool"
     *     [1]=>
     *     string(6) "string"
     *     [2]=>
     *     string(3) "int"
     *   }
     *   ["privateStaticPropertySharedName"]=>
     *   array(1) {
     *     [0]=>
     *     string(4) "bool"
     *   }
     *   ["classBExtendsClassAPrivateProperty"]=>
     *   array(1) {
     *     [0]=>
     *     string(4) "bool"
     *   }
     *   ["classBExtendsClassAPrivateStaticProperty"]=>
     *   array(1) {
     *     [0]=>
     *     string(4) "bool"
     *   }
     *   ["classABaseClassPrivateProperty"]=>
     *   array(2) {
     *     [0]=>
     *     string(5) "array"
     *     [1]=>
     *     string(4) "bool"
     *   }
     *   ["classABaseClassPrivateStaticProperty"]=>
     *   array(2) {
     *     [0]=>
     *     string(3) "int"
     *     [1]=>
     *     string(4) "bool"
     *   }
     * }
     *
     * ```
     *
     */
    private function addParentPropertyTypesToArray(
        ReflectionClass $reflectionClass,
        array &$propertyTypes,
        $filter = null
    ): void
    {
        while($parent = $reflectionClass->getParentClass()) {
            foreach($parent->getProperties($filter) as $property) {
                $type = $property->getType();
                if(!$type instanceof \ReflectionType) { continue; }
                if($type instanceof ReflectionUnionType) {
                    $this->addUnionTypesToArray(
                        $property,
                        $propertyTypes,
                        $type
                    );
                    continue;
                }
                if($type instanceof ReflectionNamedType) {
                    $this->addNamedTypeToArray(
                        $property,
                        $propertyTypes,
                        $type
                    );
                }
            }
            $reflectionClass = $parent;
        }
    }

    /**
     * Add the names of the properties declared by the parent classes
     * of the object reflected by the specified ReflectionClass
     * instance to the specified array.
     *
     * @param ReflectionClass <object> $reflectionClass
     *                                     An instance of a
     *                                     ReflectionClass that
     *                                     reflects the class or
     *                                     object instance whose
     *                                     parent's property names
     *                                     should be added to the
     *                                     specified array of
     *                                     $propertyNames.
     *
     * @param array<int, string> &$propertyNames The array to add the
     *                                           property names to.
     *
     * @param int|null $filter Determine what property names are
     *                         added to the specified array of
     *                         $propertyNames based on the following
     *                         filters:
     *
     *                         Reflection::IS_FINAL
     *                         Reflection::IS_PRIVATE
     *                         Reflection::IS_PROTECTED
     *                         Reflection::IS_PUBLIC
     *                         Reflection::IS_STATIC
     *
     *                         The names of all of the properties
     *                         declared by the parents of the
     *                         reflected class or object instance
     *                         that meet the expectation of the
     *                         given filters will be added to the
     *                         specified array of $propertyNames.
     *
     *                         If no filters are specified, then
     *                         the names of all of the properties
     *                         declared by the parents of the
     *                         reflected class or object instance
     *                         will be added to the specified array
     *                         of $propertyNames.
     *
     *                         Note: Note that some bitwise
     *                         operations will not work with these
     *                         filters. For instance a bitwise
     *                         NOT (~), will not work as expected.
     *                         For example, it is not possible to
     *                         target all non-static properties
     *                         via a call like:
     *
     *                         ```
     *                         $this->
     *                         determineReflectedClassesPropertyNames(
     *                             ~Reflection::IS_STATIC
     *                         );
     *
     *                         ```
     *
     * @return void
     *
     * @example
     *
     * ```
     * var_dump($this->type());
     *
     * // example output:
     * object(roady\classes\strings\ClassString)#4 (1) {
     *   ["string":"roady\classes\strings\Text":private]=>
     *   string(73) "tests\dev\mock\classes\ClassDExtendsClassCInheirtsFromClassBAndFromClassA"
     * }
     *
     * $propertyNames = [];
     *
     * $reflection->addParentPropertyNamesToArray(
     *     $this->reflectionClass(),
     *     $propertyNames,
     *     Reflection::IS_PRIVATE
     * );
     *
     * var_dump($propertyNames);
     *
     * // example output:
     * array(12) {
     *   [0]=>
     *   string(52) "classCExtendsClassBInheirtsFromClassAPrivateProperty"
     *   [1]=>
     *   string(58) "classCExtendsClassBInheirtsFromClassAPrivateStaticProperty"
     *   [2]=>
     *   string(25) "privatePropertySharedName"
     *   [3]=>
     *   string(31) "privateStaticPropertySharedName"
     *   [4]=>
     *   string(34) "classBExtendsClassAPrivateProperty"
     *   [5]=>
     *   string(40) "classBExtendsClassAPrivateStaticProperty"
     *   [6]=>
     *   string(25) "privatePropertySharedName"
     *   [7]=>
     *   string(31) "privateStaticPropertySharedName"
     *   [8]=>
     *   string(30) "classABaseClassPrivateProperty"
     *   [9]=>
     *   string(36) "classABaseClassPrivateStaticProperty"
     *   [10]=>
     *   string(25) "privatePropertySharedName"
     *   [11]=>
     *   string(31) "privateStaticPropertySharedName"
     * }
     *
     * ```
     *
     */
    private function addParentPropertyNamesToArray(
        ReflectionClass $reflectionClass,
        array &$propertyNames,
        $filter = null
    ): void
    {
        while($parent = $reflectionClass->getParentClass()) {
            foreach($parent->getProperties($filter) as $property) {
                array_push($propertyNames, $property->getName());
            }
            $reflectionClass = $parent;
        }
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
     * var_dump($reflection->type());
     *
     * // example output:
     * object(roady\classes\strings\ClassString)#4 (1) {
     *   ["string":"roady\classes\strings\Text":private]=>
     *   string(36) "tests\dev\mock\classes\PublicMethods"
     * }
     *
     * var_dump(
     *     $reflection->reflectionMethod('publicMethodToReturnInt')
     * );
     *
     * // example output:
     * object(ReflectionMethod)#4 (2) {
     *   ["name"]=>
     *   string(23) "publicMethodToReturnInt"
     *   ["class"]=>
     *   string(36) "tests\dev\mock\classes\PublicMethods"
     * }
     *
     * ```
     *
     */
    protected function reflectionMethod(
        string $method
    ): ReflectionMethod
    {
        return new ReflectionMethod(
            $this->type()->__toString(),
            $method
        );
    }

    /**
     * Add an array of strings indicating the types reflected by
     * the specified $reflectionUnionType to the specified array of
     * $types.
     *
     * If the $reflectionUnionType is nullable, then the string
     * "null" will be included in the array of strings.
     *
     * The array of strings will be indexed in the array of $types
     * by the specified $parameterOrProperty's name.
     *
     * @param ReflectionParameter|ReflectionProperty $parameterOrProperty
     *                                           An instance of a
     *                                           ReflectionParameter
     *                                           or a
     *                                           ReflectionProperty
     *                                           that reflects the
     *                                           parameter or
     *                                           property whose name
     *                                           will be used to
     *                                           index the array of
     *                                           strings indicating
     *                                           the types reflected
     *                                           by the specified
     *                                           $reflectionUnionType.
     *
     * @param array<string, array<int, string>> &$types
     *                                             The array of $types
     *                                             to add the array of
     *                                             strings indicating
     *                                             the types reflected
     *                                             by the specified
     *                                             ReflectionUnionType
     *                                             to.
     *
     * @param ReflectionUnionType $reflectionUnionType
     *                                            An instance of a
     *                                            ReflectionUnionType
     *                                            that reflects the
     *                                            types that are to
     *                                            be represented in
     *                                            the array that will
     *                                            be added to the
     *                                            specified array of
     *                                            $types.
     *
     * @return void
     *
     * @example
     *
     * ```
     * var_dump($this->type());
     *
     * // example output:
     * object(roady\classes\strings\ClassString)#4 (1) {
     *   ["string":"roady\classes\strings\Text":private]=>
     *   string(73) "tests\dev\mock\classes\ClassDExtendsClassCInheirtsFromClassBAndFromClassA"
     * }
     *
     * $types = [];
     *
     * $reflectionProperty = new \ReflectionProperty(
     *     $this->type()->__toString(),
     *     'classDExtendsClassCInheirtsFromClassBAndFromClassAPublicProperty'
     * );
     *
     * $reflectionUnionType = $reflectionProperty->getType();
     *
     * $this->addUnionTypesToArray(
     *     $reflectionProperty,
     *     $types,
     *     $reflectionUnionType
     * );
     *
     * var_dump($types);
     *
     * // example output:
     *
     * array(1) {
     *   ["classDExtendsClassCInheirtsFromClassBAndFromClassAPublicProperty"]=>
     *   array(3) {
     *     [0]=>
     *     string(3) "int"
     *     [1]=>
     *     string(4) "bool"
     *     [2]=>
     *     string(4) "null"
     *   }
     * }
     *
     * ```
     *
     */
    private function addUnionTypesToArray(
        ReflectionProperty|ReflectionParameter
        $parameterOrProperty,
        array &$types,
        ReflectionUnionType $reflectionUnionType
    ): void
    {
        $reflectionUnionTypes = $reflectionUnionType->getTypes();
        foreach($reflectionUnionTypes as $unionType) {
            $types[$parameterOrProperty->getName()][]
                = $unionType->getName();
            $types[$parameterOrProperty->getName()] =
                array_unique(
                    $types[$parameterOrProperty->getName()]
                );
        }
        if(
            !in_array(
                'null',
                $types[$parameterOrProperty->getName()]
            )
            &&
            $reflectionUnionType->allowsNull()
        ) {
            $types[$parameterOrProperty->getName()][]
                = 'null';
        }
    }


    /**
     * Add an array of strings indicating the types reflected by the
     * specified $reflectionNamedType to the specified array of
     * $types.
     *
     * If the $reflectionNamedType is nullable, then the string
     * "null" will also be included in the array of strings.
     *
     * The array of strings will be indexed in the array of $types
     * by the specified $parameterOrProperty's name.
     *
     * @param ReflectionParameter|ReflectionProperty $parameterOrProperty
     *                                           An instance of a
     *                                           ReflectionParameter
     *                                           or a
     *                                           ReflectionProperty
     *                                           that reflects the
     *                                           parameter or
     *                                           property whose name
     *                                           will be used to
     *                                           index the array of
     *                                           strings indicating
     *                                           the types reflected
     *                                           by the specified
     *                                           $reflectionNamedType.
     *
     * @param array<string, array<int, string>> &$types
     *                                             The array of $types
     *                                             to add the array of
     *                                             strings indicating
     *                                             the types reflected
     *                                             by the specified
     *                                             ReflectionNamedType
     *                                             to.
     *
     * @param ReflectionNamedType $reflectionNamedType
     *                                            An instance of a
     *                                            ReflectionNamedType
     *                                            that reflects the
     *                                            types that are to
     *                                            be indicated by
     *                                            strings in the
     *                                            array that will be
     *                                            added to the
     *                                            specified array of
     *                                            $types.
     *
     * @return void
     *
     * @example
     *
     * ```
     * var_dump($this->type());
     *
     * // example output:
     * object(roady\classes\strings\ClassString)#4 (1) {
     *   ["string":"roady\classes\strings\Text":private]=>
     *   string(73) "tests\dev\mock\classes\ClassDExtendsClassCInheirtsFromClassBAndFromClassA"
     * }
     *
     * $types = [];
     *
     * $reflectionProperty = new \ReflectionProperty(
     *     $this->type()->__toString(),
     *     'classDExtendsClassCInheirtsFromClassBAndFromClassAPublicStaticProperty'
     * );
     *
     * $reflectionNamedType = $reflectionProperty->getType();
     *
     * $reflection->addNamedTypeToArray(
     *     $reflectionProperty,
     *     $types,
     *     $reflectionNamedType
     * );
     *
     * var_dump($types);
     *
     * // example output:
     * array(1) {
     *   ["classDExtendsClassCInheirtsFromClassBAndFromClassAPublicStaticProperty"]=>
     *   array(1) {
     *     [0]=>
     *     string(4) "bool"
     *   }
     * }
     *
     * ```
     *
     */
    private function addNamedTypeToArray(
        ReflectionProperty|ReflectionParameter $parameterOrProperty,
        array &$types,
        ReflectionNamedType $reflectionNamedType
    ): void
    {
        $types[$parameterOrProperty->getName()] =
            [$reflectionNamedType->getName()];
        if($reflectionNamedType->allowsNull()) {
            $types[$parameterOrProperty->getName()][] =
                'null';
        }
    }

    /**
     * Return the ReflectionClass instance that reflects the
     * class-string or object reflected by this Reflection.
     *
     * @return ReflectionClass<object>
     *
     * @example
     *
     * ```
     * var_dump($this->reflectionClass());
     *
     * // example output:
     * object(ReflectionClass)#3 (1) {
     *   ["name"]=>
     *   string(36) "tests\dev\mock\classes\PublicMethods"
     * }
     *
     * ```
     *
     */
    protected function reflectionClass(): ReflectionClass
    {
        return $this->reflectionClass;
    }

}

