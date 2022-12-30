<?php

namespace roady\interfaces\utilities;

use ReflectionException;
use ReflectionMethod;
use roady\interfaces\strings\ClassString;

/**
 * A Reflection can be used to get information about a reflected
 * class or object instance.
 *
 * @example
 *
 * ```
 * var_dump($reflection->methodNames());
 *
 * // example output:
 *
 * array(2) {
 *   [0]=>
 *   string(7) "method1"
 *   [1]=>
 *   string(7) "method2"
 * }
 *
 * ```
 *
 */
interface Reflection
{

    /**
     * The Reflection::IS_FINAL constant is an alias for the
     * ReflectionMethod::IS_FINAL constant.
     *
     * The Reflection::IS_FINAL constant can be passed to the
     * methodNames() method to indicate that the names of the
     * final methods defined by the reflected class or object
     * instance should be included in the returned array.
     *
     * @see ReflectionMethod::IS_FINAL
     *
     */
    public const IS_FINAL = ReflectionMethod::IS_FINAL;

    /**
     * The Reflection::IS_ABSTRACT constant is an alias for the
     * ReflectionMethod::IS_ABSTRACT constant.
     *
     * The Reflection::IS_ABSTRACT constant can be passed to the
     * methodNames() method to indicate that the names of the
     * abstract methods defined by the reflected class or object
     * instance should be included in the returned array.
     *
     * @see ReflectionMethod::IS_ABSTRACT
     *
     */
    public const IS_ABSTRACT = ReflectionMethod::IS_ABSTRACT;

    /**
     * The Reflection::IS_PRIVATE constant is an alias for the
     * ReflectionMethod::IS_PRIVATE constant.
     *
     * The Reflection::IS_PRIVATE constant can be passed to the
     * methodNames() method to indicate that the names of the
     * private methods defined by the reflected class or object
     * instance should be included in the returned array.
     *
     * @see ReflectionMethod::IS_PRIVATE
     *
     */
    public const IS_PRIVATE = ReflectionMethod::IS_PRIVATE;

    /**
     * The Reflection::IS_PROTECTED constant is an alias for the
     * ReflectionMethod::IS_PROTECTED constant.
     *
     * The Reflection::IS_PROTECTED constant can be passed to the
     * methodNames() method to indicate that the names of the
     * protected methods defined by the reflected class or object
     * instance should be included in the returned array.
     *
     * @see ReflectionMethod::IS_PROTECTED
     *
     */
    public const IS_PROTECTED = ReflectionMethod::IS_PROTECTED;

    /**
     * The Reflection::IS_PUBLIC constant is an alias for the
     * ReflectionMethod::IS_PUBLIC constant.
     *
     * The Reflection::IS_PUBLIC constant can be passed to the
     * methodNames() method to indicate that the names of the
     * public methods defined by the reflected class or object
     * instance should be included in the returned array.
     *
     * @see ReflectionMethod::IS_PUBLIC
     *
     */
    public const IS_PUBLIC = ReflectionMethod::IS_PUBLIC;

    /**
     * The Reflection::IS_STATIC constant is an alias for the
     * ReflectionMethod::IS_STATIC constant.
     *
     * The Reflection::IS_STATIC constant can be passed to the
     * methodNames() method to indicate that the names of the
     * static methods defined by the reflected class or object
     * instance should be included in the returned array.
     *
     * @see ReflectionMethod::IS_STATIC
     *
     */
    public const IS_STATIC = ReflectionMethod::IS_STATIC;

    /**
     * Return a numerically indexed array of the names of the
     * methods defined by the reflected class or object instance.
     *
     * @param int|null $filter Determine what method names are
     *                         included in the returned array
     *                         based on the following filters:
     *
     *                         Reflection::IS_ABSTRACT
     *                         Reflection::IS_FINAL
     *                         Reflection::IS_PRIVATE
     *                         Reflection::IS_PROTECTED
     *                         Reflection::IS_PUBLIC
     *                         Reflection::IS_STATIC
     *
     *                         All methods defined by the reflected
     *                         class or object instance that meet the
     *                         expectation of the given filters will
     *                         be included in the returned array.
     *
     *                         If no filters are specified, then
     *                         the names of all of the methods
     *                         defined by the reflected class or
     *                         object instance will be included
     *                         in the returned array.
     *
     *                         Note: Note that some bitwise
     *                         operations will not work with these
     *                         filters. For instance a bitwise
     *                         NOT (~), will not work as expected.
     *                         For example, it is not possible to
     *                         retrieve all non-static methods via
     *                         a call like:
     *
     *                         ```
     *                         $reflection->methodNames(
     *                             ~Reflection::IS_STATIC
     *                         );
     *
     *                         ```
     *
     * @return array<int, string>
     *
     * @example
     *
     * ```
     * var_dump($reflection->methodNames());
     *
     * // example output:
     *
     * array(2) {
     *   [0]=>
     *   string(7) "method1"
     *   [1]=>
     *   string(7) "method2"
     * }
     *
     * var_dump(
     *     $reflection->methodNames(ReflectionMethod::IS_PUBLIC)
     * );
     *
     * // example output:
     *
     * array(1) {
     *   [0]=>
     *   string(7) "method1"
     * }
     *
     * var_dump(
     *     $reflection->methodNames(ReflectionMethod::IS_PRIVATE)
     * );
     *
     * // example output:
     *
     * array(1) {
     *   [0]=>
     *   string(7) "method2"
     * }
     *
     * ```
     */
    public function methodNames(int|null $filter = null): array;

    /**
     * Return a numerically indexed array of the names of the
     * parameters expected by the specified method of the reflected
     * class or object instance.
     *
     * The parameters names will be ordered according the order
     * that the parameters were declared by the respective method.
     *
     * @param string $method The name of method whose parameter
     *                       names should be included in the
     *                       returned array.
     *
     * @return array<int, string>
     *
     * @example
     *
     * ```
     * var_dump($reflection->methodParameterNames('method1'));
     *
     * // example output:
     *
     * array(7) {
     *   [0]=>
     *   string(10) "parameter1"
     *   [1]=>
     *   string(10) "parameter2"
     *   [2]=>
     *   string(10) "parameter3"
     *   [3]=>
     *   string(10) "parameter4"
     *   [4]=>
     *   string(10) "parameter5"
     *   [5]=>
     *   string(10) "parameter6"
     *   [6]=>
     *   string(10) "parameter7"
     * }
     *
     * ```
     */
    public function methodParameterNames(string $method): array;

    /**
     * Returns an associatively indexed array of numerically
     * indexed arrays of strings indicating the types expected
     * by the parameters defined by the specified method of the
     * reflected class or object instance.
     *
     * The arrays will be indexed by the name of the parameter they
     * are associated with.
     *
     * @param string $method The name of method whose parameter
     *                       types should be included in the
     *                       returned array.
     *
     * @return array<string, array<int, string>>
     *
     * @example
     *
     * ```
     * var_dump($reflection->methodParameterTypes('method1'));
     *
     * // example output:
     * var_dump($reflection->methodParameterTypes('methodParameterTypes'));
     * array(1) {
     *   ["method"]=>
     *   array(1) {
     *     [0]=>
     *     string(6) "string"
     *   }
     * }
     *
     * ```
     */
    public function methodParameterTypes(string $method): array;

    /**
     * Return a numerically indexed array of the names of the
     * properties defined by the reflected class or object instance.
     *
     * @param int|null $filter Determine what property names are
     *                         included in the returned array
     *                         based on the following filters:
     *
     *                         Reflection::IS_ABSTRACT
     *                         Reflection::IS_FINAL
     *                         Reflection::IS_PRIVATE
     *                         Reflection::IS_PROTECTED
     *                         Reflection::IS_PUBLIC
     *                         Reflection::IS_STATIC
     *
     *                         All properties defined by the reflected
     *                         class or object instance that meet the
     *                         expectation of the given filters will
     *                         be included in the returned array.
     *
     *                         If no filters are specified, then
     *                         the names of all of the properties
     *                         defined by the reflected class or
     *                         object instance will be included
     *                         in the returned array.
     *
     *                         Note: Note that some bitwise
     *                         operations will not work with these
     *                         filters. For instance a bitwise
     *                         NOT (~), will not work as expected.
     *                         For example, it is not possible to
     *                         retrieve all non-static properties via
     *                         a call like:
     *
     *                         ```
     *                         $reflection->propertyNames(
     *                             ~Reflection::IS_STATIC
     *                         );
     *
     *                         ```
     * @return array<int, string>
     *
     * @example
     *
     * ```
     * var_dump($reflection->propertyNames());
     *
     * // example output:
     *
     * array(7) {
     *   [0]=>
     *   string(9) "property1"
     *   [1]=>
     *   string(9) "property2"
     *   [2]=>
     *   string(9) "property3"
     *   [3]=>
     *   string(9) "property4"
     *   [4]=>
     *   string(9) "property5"
     *   [5]=>
     *   string(9) "property6"
     *   [6]=>
     *   string(9) "property7"
     * }
     *
     * ```
     *
     */
    public function propertyNames(int|null $filter = null): array;

    /**
     * Return an associatively indexed array of the reflected class
     * or object instance's property types.
     *
     * The types in the array will be indexed by the name of the
     * property they are associated with.
     *
     * @return array<string, string|ClassString>
     *
     * @example
     *
     * ```
     * var_dump($reflection->propertyTypes());
     *
     * // example output:
     *
     * array(7) {
     *   ["property1"]=>
     *   string(4) "bool"
     *   ["property2"]=>
     *   string(3) "int"
     *   ["property3"]=>
     *   string(5) "float"
     *   ["property4"]=>
     *   string(4) "null"
     *   ["property5"]=>
     *   string(5) "array"
     *   ["property6"]=>
     *   string(6) "string"
     *   ["property7"]=>
     *   object(roady\classes\strings\ClassString)#3 (1) {
     *     ["string":"roady\classes\strings\Text":private]=>
     *     string(24) "roady\classes\strings\Id"
     *   }
     * }
     *
     * ```
     */
    public function propertyTypes(): array;

    /**
     * Return an associatively indexed array of the reflected
     * object instance's property values.
     *
     * The values in the array will be indexed by the name of the
     * property they are associated with.
     *
     * Note: If the Reflection reflects a class as opposed to an
     * object instance, then an empty array will be returned. It
     * is not possible to determine the values of a reflected class
     * since it is not an object instance.
     *
     * @return array<string, mixed>
     *
     * @example
     *
     * ```
     * var_dump($objectInstanceReflection->propertyValues());
     *
     * // example output:
     * array(7) {
     *   ["property1"]=>
     *   bool(true)
     *   ["property2"]=>
     *   int(96215)
     *   ["property3"]=>
     *   int(19.2389)
     *   ["property4"]=>
     *   NULL
     *   ["property5"]=>
     *   array(3) {
     *     [0]=>
     *     string(3) "foo"
     *     [1]=>
     *     string(3) "bar"
     *     [2]=>
     *     string(3) "baz"
     *   }
     *   ["property6"]=>
     *   string(12) "FooBarBazzer"
     *   ["property7"]=>
     *   object(roady\classes\strings\Id)#3 (2) {
     *     ["string":"roady\classes\strings\Text":private]=>
     *     string(75) "Pos2MW2FCMh0laS66Jnpcf7gDRHtVv0aqOOoasYe6AE4lRbKCCgTxsL1UHtqPFNhZuY82tfXWMn"
     *     ["text":"roady\classes\strings\SafeText":private]=>
     *     object(roady\classes\strings\AlphanumericText)#2 (2) {
     *       ["string":"roady\classes\strings\Text":private]=>
     *       string(75) "Pos2MW2FCMh0laS66Jnpcf7gDRHtVv0aqOOoasYe6AE4lRbKCCgTxsL1UHtqPFNhZuY82tfXWMn"
     *       ["text":"roady\classes\strings\SafeText":private]=>
     *       object(roady\classes\strings\Text)#4 (1) {
     *         ["string":"roady\classes\strings\Text":private]=>
     *         string(75) "pos2MW2FCMh0laS66Jnpcf7gDRHtVv0aqOOoasYe6AE4lRbKCCgTxsL1UHtqPFNhZuY82tfXWMn"
     *       }
     *     }
     *   }
     * }
     *
     * var_dump($classReflection->propertyValues());
     *
     * // example output:
     * array(0) {
     * }
     *
     * ```
     *
     */
    public function propertyValues(): array;

    /**
     * Return the type of the reflected class or object instance
     * as a ClassString.
     *
     * @return ClassString
     *
     * @example
     *
     * ```
     * echo $reflection->type();
     * // example output: namespace\of\reflected\class\ClassName;
     *
     * ```
     *
     */
    public function type(): ClassString;

    /**
     * @devNote
     *
     * I have not decided if this method will be apart of the
     * Reflection interface.
     *
     * @endDevNote
     *
     * Return a new instance of the reflected class or object instance
     * constructed with the provided $constructorArguments.
     *
     * @param array<int, mixed> $constructorArguments The arguments
     *                                                to pass to the
     *                                                __construct()
     *                                                method of the
     *                                                reflected class.
     * @return object
     *
     * @example
     *
     * ```
     * $reflectionOfAnObjectInstance->instance();
     *
     * //
     *
     * ```
     *
     */
    // public function newInstance(array $constructorArguments = []): void;


    /**
     * @devNote
     *
     * I have not decided if this method will be apart of the
     * Reflection interface.
     *
     * @endDevNote
     *
     * Return the original reflected object instance, or a
     * ClassStriing that represents the type of the reflected
     * class.
     *
     * @return
     *
     * @example
     *
     * ```
     * var_dump($reflectionOfAnObjectInstance->reflectedClass());
     *
     * // example output:
     * object(stdClass)#1 (2) {
     *   ["foo"]=>
     *   string(3) "bar"
     *   ["baz"]=>
     *   string(6) "bazzer"
     * }
     *
     * var_dump($reflectionOfAClass->reflectedClass());
     *
     * // example output:
     * object(roady\classes\strings\ClassString)#5 (1) {
     *   ["string":"roady\classes\strings\Text":private]=>
     *   string(8) "stdClass"
     * }
     *
     * ```
     *
     */
    // public function reflectedClass(): object;

}

