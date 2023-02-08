<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PublicStaticMethods class mocks a class that defines public
 * static methods of various types.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class PublicStaticMethods
{

    /**
     * @param array<mixed> $parameterAcceptsArray
     *
     * @return array<mixed>
     */
    public static function publicStaticMethodsMethodToReturnArray(
        array $parameterAcceptsArray,
        ?bool $parameterAcceptsBoolOrNull = null
    ) : array
    {
        return (
            empty($parameterAcceptsArray)
            ? array_merge(
                array_fill(
                    intval($parameterAcceptsBoolOrNull),
                    rand(1, 100),
                    rand(1, 100)
                )
            )
            : [$parameterAcceptsBoolOrNull]
        );
    }

    public static function publicStaticMethodsMethodToReturnBool(
        ?int $parameterAcceptsIntOrNull = null
    ) : bool
    {
        return (
            $parameterAcceptsIntOrNull > rand(1, 100)
            ? true
            : false
        );
    }

    public static function publicStaticMethodsMethodToReturnClosure(
        string $parameterAcceptsString,
        ?bool $parameterAcceptsBoolOrNull = null
    ) : Closure
    {
        return function(): void {};
    }

    public static function publicStaticMethodsMethodToReturnInt(
        int $parameterAcceptsInt
    ) : int
    {
        return rand(
            $parameterAcceptsInt,
            $parameterAcceptsInt + rand(10, 1000)
        );
    }

    public static function publicStaticMethodsMethodToReturnFloat(
        ?bool $parameterAcceptsBoolOrNull = null
    ) : float
    {
        return floatval(strval(rand(1, 10)) . strval(rand(1, 100)));
    }

    public static function publicStaticMethodsMethodToReturnNullableObject(
        ?bool $parameterAcceptsBoolOrNull = null)
        : ?object
    {
        return (rand(0, 1) === 1 ? new \stdClass() : null);
    }

    public static function publicStaticMethodsMethodToReturnObject(
        ?object $parameterAcceptsObjectOrNull = null
    ) : object
    {
        $object = new \stdClass();
        $object->publicProperty = $object;
        return $object;
    }

    public static function publicStaticMethodsMethodToReturnString(
        ?bool $parameterAcceptsBoolOrNull = null
    ) : string
    {
        return $parameterAcceptsBoolOrNull ? 'Foo bar baz' : '';
    }


}
