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
     * @return array<int, int>
     */
    public static function publicStaticMethodsMethodToReturnArray() : array
    {
        return array_fill(0, rand(1, 100), rand(1, 100));
    }

    public static function publicStaticMethodsMethodToReturnBool() : bool
    {
        return (rand(0,1) === 1 ? true : false);
    }

    public static function publicStaticMethodsMethodToReturnClosure() : Closure
    {
        return function(): void {};
    }

    public static function publicStaticMethodsMethodToReturnInt() : int
    {
        return rand(1, 100);
    }

    public static function publicStaticMethodsMethodToReturnFloat() : float
    {
        return floatval(strval(rand(1, 10)) . strval(rand(1, 100)));
    }

    public static function publicStaticMethodsMethodToReturnNullableObject() : ?object
    {
        return (rand(0, 1) === 1 ? new \stdClass() : null);
    }

    public static function publicStaticMethodsMethodToReturnObject() : object
    {
        return new \stdClass();
    }

    public static function publicStaticMethodsMethodToReturnString() : string
    {
        return 'Foo bar baz';
    }


}
