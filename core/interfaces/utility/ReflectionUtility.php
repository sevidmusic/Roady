<?php

namespace roady\interfaces\utility;

use ReflectionClass;
use ReflectionException;

/**
 * A ReflectionUtility can be used to reflect or get information
 * about a class or an object.
 *
 * Methods:
 *
 * getClassPropertyNames(string|object $class): array;
 * getClassPropertyTypes(string|object $class): array;
 * getClassPropertyValues(string|object $class): array;
 * getClassInstance(string|object $class, array $constructorArguments = array()): object;
 * getClassMethodParameterNames(string|object $class, string $method): array;
 * getClassMethodParameterTypes(string|object $class, string $method): array;
 * generateMockClassMethodArguments(string|object $class, string $method): array;
 * getClassReflection(string|object $class): ReflectionClass;
 *
 */
interface ReflectionUtility
{
    /**
     * Return a numerically indexed array of the specified class
     * or object's property names.
     *
     * @param class-string<object>|object $class A fully qualified
     *                                           class name, or an
     *                                           object instance.
     *
     * @return array<int, string> A numerically indexed array of
     *                            the specified class or object's
     *                            property names.
     */
    public function getClassPropertyNames(string|object $class): array;

    /**
     * Return an array of the specified class or object's property
     * types indexed by property name.
     *
     * @param class-string<object>|object $class A fully qualified
     *                                           class name, or an
     *                                           object instance.
     *
     * @return array<string, string> An array of the specified
     *                               class or object's property
     *                               types indexed by property
     *                               name.
     */
    public function getClassPropertyTypes(string|object $class): array;

    /**
     * If a fully qualified class name is specified, then
     * return an array of randomly generated property values
     * of the appropriate type for the specified class indexed
     * by property name.
     *
     * If an object instance is specified, then return an
     * array of the specified object instance's actual property
     * values indexed by property name.
     *
     * @param class-string<object>|object $class A fully qualified
     *                                           class name, or an
     *                                           object instance.
     *
     * @return array<string, mixed> Either an array of randomly
     *                              generated property values of
     *                              the appropriate type for the
     *                              specified class indexed by
     *                              property name, or, an array of
     *                              the specified object instance's
     *                              actual property values indexed
     *                              by property name.
     */
    public function getClassPropertyValues(string|object $class): array;

    /**
     * Return a new unique object instance of the same type as the
     * specified class or object instance.
     *
     * Note: The new instance's properties will be assigned values
     * of the proper type, but the values may be randomly generated,
     * so it may not be possible to predict what the values will
     * actually be.
     *
     * Note: Any properties that are set by the specified class's
     * __construct() method will be honored.
     *
     * For example, if the specified class or object defines a
     * property named $foo that holds a boolean value, the
     * returned object instance's $foo property will be assigned
     * a boolean, but it is not possible to predict if $foo will
     * be assigned a true or false value.
     *
     * @param class-string<object>|object $class A fully qualified
     *                                           class name, or an
     *                                           object instance.
     *
     * @param array<int, mixed> $constructorArguments An array of
     *                                           arguments to pass
     *                                           to the new object's
     *                                           constructor. The
     *                                           arguments should be
     *                                           ordered according
     *                                           to the order expected
     *
     * @return object A new object instance of the same type as the
     *                specified class or object instance.
     *
     * @throws ReflectionException If the object instance of the
     *                             same type as the specified class
     *                             cannot be instantiated for any
     *                             reason, a ReflectionException
     *                             will be thrown.
     *
     */
    public function getClassInstance(string|object $class, array $constructorArguments = array()): object;

    /**
     * Return a numerically indexed array of the names of the
     * parameters expected by a specified method of a specified
     * class or object instance.
     *
     * The order of the names in the array will correspond to the
     * parameter order defined by the specified method.
     *
     * @param class-string<object>|object $class A fully qualified
     *                                           class name, or an
     *                                           object instance.
     *
     * @return array<int, string> A numerically indexed array of the
     *                            names of the parameters expected by
     *                            a specified method of a specified
     *                            class or object instance.
     */
    public function getClassMethodParameterNames(string|object $class, string $method): array;

    /**
     * Return a numerically indexed array of the types of the
     * parameters expected by a specified method of a specified
     * class or object instance.
     *
     * The order of the types in the array will correspond to the
     * parameter order defined by the specified method.
     *
     * @param class-string<object>|object $class A fully qualified
     *                                           class name, or an
     *                                           object instance.
     *
     * @return array<int, string> A numerically indexed array of
     *                            the types of the parameters
     *                            expected by a specified method
     *                            of a specified class or object
     *                            instance.
     */
    public function getClassMethodParameterTypes(string|object $class, string $method): array;

    /**
     * Return a numerically indexed array of mock method arguments
     * of the appropriate type for a specified method of a specified
     * class or object instance.
     *
     * The order of the mock arguments in the array will correspond
     * to the parameter order defined by the specified method.
     *
     * Note: Though the mock arguments types will be correct, their
     * actual values will not always be predictable.
     *
     * @param class-string<object>|object $class A fully qualified
     *                                           class name, or an
     *                                           object instance.
     *
     * @param string $method The name of the method to generate mock
     *                       arguments for.
     *
     * @return array<int, mixed> A numerically indexed array of mock
     *                           method arguments of the appropriate
     *                           type for a specified method of a
     *                           specified class or object instance.
     */
    public function generateMockClassMethodArguments(string|object $class, string $method): array;

    /**
     * Return an instance of PHP's ReflectionClass for the specified
     * class or object instance.
     *
     * @param class-string<object>|object $class A fully qualified
     *                                           class name, or an
     *                                           object instance.
     *
     * @return ReflectionClass<object> An instance of PHP's
     *                                 ReflectionClass for the
     *                                 specified class or object
     *                                 instance.
     *
     * @see https://www.php.net/manual/en/class.reflectionclass.php
     */
    public function getClassReflection(string|object $class): ReflectionClass;

}
