<?php

namespace roady\interfaces\utilities;

use ReflectionException;
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
     * Return a numerically indexed array of the names of the
     * methods defined by the reflected class or object instance.
     *
     * @param int|null $filter Determine what method names are
     *                         included in the returned array
     *                         based on the following filters:
     *
     *                         ReflectionMethod::IS_STATIC
     *                         ReflectionMethod::IS_PUBLIC
     *                         ReflectionMethod::IS_PROTECTED
     *                         ReflectionMethod::IS_PRIVATE
     *                         ReflectionMethod::IS_ABSTRACT
     *                         ReflectionMethod::IS_FINAL
     *
     *                         All methods with fit the expectation
     *                         of the given filters will be included
     *                         in the returned array.
     *
     *                         If filters are not specified, then
     *                         all of the class's method names will
     *                         be included in the returned array.
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
     *                             ~ReflectionMethod::IS_STATIC
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
     * Return an associatively indexed array of the parameter types
     * expected by the specified method of the reflected class or
     * object instance.
     *
     * The types in the array will be indexed by the name of the
     * parameter they are associated with.
     *
     * The parameters types will be ordered according the order
     * that the parameters were declared by the respective method.
     *
     * @param string $method The name of method whose parameter
     *                       types should be included in the
     *                       returned array.
     *
     * @return array<string, string|ClassString>
     *
     * @example
     *
     * ```
     * var_dump($reflection->methodParameterTypes('method1'));
     *
     * // example output:
     *
     * array(7) {
     *   ["parameter1"]=>
     *   string(4) "bool"
     *   ["parameter2"]=>
     *   string(3) "int"
     *   ["parameter3"]=>
     *   string(5) "float"
     *   ["parameter4"]=>
     *   string(4) "null"
     *   ["parameter5"]=>
     *   string(5) "array"
     *   ["parameter6"]=>
     *   string(6) "string"
     *   ["parameter7"]=>
     *   object(roady\classes\strings\ClassString)#3 (1) {
     *     ["string":"roady\classes\strings\Text":private]=>
     *     string(24) "roady\classes\strings\Id"
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
    public function propertyNames(): array;

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

}

