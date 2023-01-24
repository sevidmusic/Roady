<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PrivateStaticMethods class mocks a class that defines private
 * static methods of various types, and a public method to call all
 * of the private static methods.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class PrivateStaticMethods
{

    /**
     * @return array<int, int>
     */
    private static function privateStaticMethodsMethodToReturnArray() : array
    {
        return array_fill(0, rand(1, 100), rand(1, 100));
    }

    private static function privateStaticMethodsMethodToReturnBool() : bool
    {
        return (rand(0,1) === 1 ? true : false);
    }

    private static function privateStaticMethodsMethodToReturnClosure() : Closure
    {
        return function(): void {};
    }

    private static function privateStaticMethodsMethodToReturnInt() : int
    {
        return rand(1, 100);
    }

    private static function privateStaticMethodsMethodToReturnFloat() : float
    {
        return floatval(strval(rand(1, 10)) . strval(rand(1, 100)));
    }

    private static function privateStaticMethodsMethodToReturnNullableObject() : ?object
    {
        return (rand(0, 1) === 1 ? new \stdClass() : null);
    }

    private static function privateStaticMethodsMethodToReturnObject() : object
    {
        return new \stdClass();
    }

    private static function privateStaticMethodsMethodToReturnString() : string
    {
        return 'Foo bar baz';
    }

    public function callAll(): void
    {
        var_dump(
            $this->privateStaticMethodsMethodToReturnArray(),
            $this->privateStaticMethodsMethodToReturnBool(),
            $this->privateStaticMethodsMethodToReturnClosure(),
            $this->privateStaticMethodsMethodToReturnInt(),
            $this->privateStaticMethodsMethodToReturnFloat(),
            $this->privateStaticMethodsMethodToReturnNullableObject(),
            $this->privateStaticMethodsMethodToReturnObject(),
            $this->privateStaticMethodsMethodToReturnString(),
        );

    }

}
