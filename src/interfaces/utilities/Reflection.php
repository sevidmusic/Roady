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
 * var_dump($reflection->methodNames(Reflection::IS_PUBLIC));
 *
 * // example output:
 * array(6) {
 *   [0]=>
 *   string(11) "methodNames"
 *   [1]=>
 *   string(20) "methodParameterNames"
 *   [2]=>
 *   string(20) "methodParameterTypes"
 *   [3]=>
 *   string(13) "propertyNames"
 *   [4]=>
 *   string(13) "propertyTypes"
 *   [5]=>
 *   string(4) "type"
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
     * The Reflection::IS_FINAL constant can be used to filter
     * the results of the methodNames(), propertyNames(), and
     * propertyTypes() methods.
     *
     * @see ReflectionMethod::IS_FINAL
     *
     */
    public const IS_FINAL = ReflectionMethod::IS_FINAL;

    /**
     * The Reflection::IS_ABSTRACT constant is an alias for the
     * ReflectionMethod::IS_ABSTRACT constant.
     *
     * The Reflection::IS_ABSTRACT constant can be used to filter
     * the results of the methodNames(), propertyNames(), and
     * propertyTypes() methods.
     *
     * @see ReflectionMethod::IS_ABSTRACT
     *
     */
    public const IS_ABSTRACT = ReflectionMethod::IS_ABSTRACT;

    /**
     * The Reflection::IS_PRIVATE constant is an alias for the
     * ReflectionMethod::IS_PRIVATE constant.
     *
     * The Reflection::IS_PRIVATE constant can be used to filter
     * the results of the methodNames(), propertyNames(), and
     * propertyTypes() methods.
     *
     * @see ReflectionMethod::IS_PRIVATE
     *
     */
    public const IS_PRIVATE = ReflectionMethod::IS_PRIVATE;

    /**
     * The Reflection::IS_PROTECTED constant is an alias for the
     * ReflectionMethod::IS_PROTECTED constant.
     *
     * The Reflection::IS_PROTECTED constant can be used to filter
     * the results of the methodNames(), propertyNames(), and
     * propertyTypes() methods.
     *
     * @see ReflectionMethod::IS_PROTECTED
     *
     */
    public const IS_PROTECTED = ReflectionMethod::IS_PROTECTED;

    /**
     * The Reflection::IS_PUBLIC constant is an alias for the
     * ReflectionMethod::IS_PUBLIC constant.
     *
     * The Reflection::IS_PUBLIC constant can be used to filter
     * the results of the methodNames(), propertyNames(), and
     * propertyTypes() methods.
     *
     * @see ReflectionMethod::IS_PUBLIC
     *
     */
    public const IS_PUBLIC = ReflectionMethod::IS_PUBLIC;

    /**
     * The Reflection::IS_STATIC constant is an alias for the
     * ReflectionMethod::IS_STATIC constant.
     *
     * The Reflection::IS_STATIC constant can be used to filter
     * the results of the methodNames(), propertyNames(), and
     * propertyTypes() methods.
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
     *                         The names of the methods defined
     *                         by the reflected class or object
     *                         instance that meet the expectation
     *                         of the given filters will be included
     *                         in the returned array.
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
     *                         retrieve the names of all of the
     *                         non-static methods via a call like:
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
     *
     * var_dump($reflection->methodNames(Reflection::IS_PUBLIC));
     *
     * // example output:
     * array(6) {
     *   [0]=>
     *   string(11) "methodNames"
     *   [1]=>
     *   string(20) "methodParameterNames"
     *   [2]=>
     *   string(20) "methodParameterTypes"
     *   [3]=>
     *   string(13) "propertyNames"
     *   [4]=>
     *   string(13) "propertyTypes"
     *   [5]=>
     *   string(4) "type"
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
     * var_dump(
     *     $reflection->methodParameterNames('methodParameterNames')
     * );
     *
     * // example output:
     * array(1) {
     *   [0]=>
     *   string(6) "method"
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
     * The arrays of strings indicating the accepted types will be
     * indexed by the name of the parameter they are associated with.
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
     * var_dump(
     *     $reflection->methodParameterTypes('methodParameterTypes')
     * );
     *
     * // example output:
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
     * properties declared by the reflected class or object instance.
     *
     * @param int|null $filter Determine what property names are
     *                         included in the returned array
     *                         based on the following filters:
     *
     *                         Reflection::IS_FINAL
     *                         Reflection::IS_PRIVATE
     *                         Reflection::IS_PROTECTED
     *                         Reflection::IS_PUBLIC
     *                         Reflection::IS_STATIC
     *
     *                         The names of the properties declared
     *                         by the reflected class or object
     *                         instance that meet the expectation of
     *                         the given filters will be included in
     *                         the returned array.
     *
     *                         If no filters are specified, then
     *                         the names of all of the properties
     *                         declared by the reflected class or
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
     * Return an associatively indexed array of numerically
     * indexed arrays of strings indicating the types accepted
     * by the properties declared by the reflected class or
     * object instance.
     *
     * The arrays of strings indicating the accepted types will be
     * indexed by the name of the property they are associated with.
     *
     * @param int|null $filter Determine which property's types
     *                         are included in the returned array
     *                         based on the following filters:
     *
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
     *                         the types of all of the properties
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
     *                         $reflection->propertyTypes(
     *                             ~Reflection::IS_STATIC
     *                         );
     *
     *                         ```
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
     * array(6) {
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
     * }
     *
     * ```
     */
    public function propertyTypes(int $filter = null): array;

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

