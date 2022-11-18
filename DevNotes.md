Once the `roady\interfaces\utilities\Reflection` interface is
implemented, implement the following interface:

```
<?php

namespace roady\interfaces\utilities;

/**
 * A Reflector can be used to mock a new instance of a class , or mock
 * the arguments of a method of a class or object instance that is
 * reflected by a Reflection instance.
 */
interface Reflector
{
    /**
     * Return a numerically indexed array of mock method arguments
     * of the appropriate type for a specified method of the
     * class or object instance reflected by the specified Reflection.
     *
     * The order of the mock arguments in the array will correspond
     * to the parameter order defined by the specified method.
     *
     * Note: Though the mock arguments types will be correct, their
     * actual values will not be predictable.
     *
     * @param Reflection $reflection A Reflection of the class or
     *                               object instance that defined
     *                               the method.
     *
     * @param string $method The name of the method to generate mock
     *                       arguments for.
     *
     * @return array<int, mixed> A numerically indexed array of mock
     *                           method arguments of the appropriate
     *                           type for the specified method of the
     *                           class or object instance reflected
     *                           by the specified Reflection.
     *
     * @example
     *
     * ```
     *
     * var_dump(
     *     $reflection->mockClassMethodArguments($reflection, 'method1')
     * );
     *
     * // example output:
     *
     * array(7) {
     *   ["foo"]=>
     *   bool(true)
     *   ["bar"]=>
     *   string(6) "string"
     *   ["baz"]=>
     *   array(0) {
     *   }
     *   ["bin"]=>
     *   int(0)
     *   ["oof"]=>
     *   float(1.7)
     *   ["rab"]=>
     *   NULL
     *   ["zab"]=>
     *   object(roady\classes\utilities\Reflection)#3 (0) {
     *   }
     * }
     *
     * ```
     *
     */
    public function mockClassMethodArguments(
        Reflection $reflection,
        string $method
    ): array;

    /**
     * Return a new instance of the same type as the class or object
     * instance reflected by the specified Reflection.
     *
     * Note: The new instance's properties will be assigned values
     * of the proper type, but the values will be randomly generated.
     * It is not be possible to predict what the values will actually
     * be.
     *
     * If the class defines a __construct method, it will be called
     * using the arguments supplied to the $constructorArguments
     * parameter.
     *
     * @param ClassString|object $reflection A Reflection of a class
     *                                       or object instance
     *                                       whose type matches the
     *                                       type of object that
     *                                       should be returned.
     *
     * @param array<int, mixed> $constructorArguments An array of
     *                                                arguments to
     *                                                pass to the
     *                                                class's
     *                                                constructor.
     *                                                The arguments
     *                                                must be
     *                                                ordered
     *                                                according to the
     *                                                order expected
     *                                                by the
     *                                                constructor.
     *                                                The arguments
     *                                                must be of the
     *                                                proper type.
     *                                                If the class
     *                                                does not define
     *                                                a constructor,
     *                                                then this
     *                                                parameter can
     *                                                be omitted.
     *
     * @return object A new object instance of the same type as the
     *                class or object instance reflected by the
     *                specified Reflection.
     *
     * @throws ReflectionException If an instance of the
     *                             proper type cannot be
     *                             instantiated for any reason,
     *                             then a ReflectionException
     *                             will be thrown.
     */
    public function newClassInstance(
        Reflection $reflection,
        array $constructorArguments = []
    ): object;

}

```


