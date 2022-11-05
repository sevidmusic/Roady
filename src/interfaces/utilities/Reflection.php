<?php

namespace roady\interfaces\utilities;

use ReflectionException;
use roady\interfaces\strings\ClassString;

/**
 * A Reflection can be used to get information about a class
 * or object instance.
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
     * ```
     */
    public function methodNames(): array;

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
     *   string(3) "foo"
     *   [1]=>
     *   string(3) "bar"
     *   [2]=>
     *   string(3) "baz"
     *   [3]=>
     *   string(3) "bin"
     *   [4]=>
     *   string(3) "oof"
     *   [5]=>
     *   string(3) "rab"
     *   [6]=>
     *   string(3) "zab"
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
     * @return array<string, string>
     *
     * @example
     *
     * ```
     * var_dump($reflection->methodParameterTypes('method1'));
     *
     * // example output:
     *
     * array(7) {
     *   ["foo"]=>
     *   string(4) "bool"
     *   ["bar"]=>
     *   string(6) "string"
     *   ["baz"]=>
     *   string(5) "array"
     *   ["bin"]=>
     *   string(3) "int"
     *   ["oof"]=>
     *   string(5) "float"
     *   ["rab"]=>
     *   string(4) "null"
     *   ["zab"]=>
     *   string(34) "roady\classes\utilities\Reflection"
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
     * array(2) {
     *   [0]=>
     *   string(7) "property1"
     *   [1]=>
     *   string(7) "property2"
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
     * @return array<string, string>
     *
     * @example
     *
     * ```
     * var_dump($reflection->propertyTypes());
     *
     * // example output:
     *
     * array(7) {
     *   ["foo"]=>
     *   string(4) "bool"
     *   ["bar"]=>
     *   string(6) "string"
     *   ["baz"]=>
     *   string(5) "array"
     *   ["bin"]=>
     *   string(3) "int"
     *   ["oof"]=>
     *   string(5) "float"
     *   ["rab"]=>
     *   string(4) "null"
     *   ["zab"]=>
     *   string(34) "roady\classes\utilities\Reflection"
     * }
     *
     * ```
     */
    public function propertyTypes(): array;

}

