<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The ProtectedStaticMethods class mocks a class that defines
 * protected static methods of various types, and a public method
 * to call all of the protected static methods.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class ProtectedStaticMethods
{

    /**
     * @return array<int, int>
     */
    protected static function protectedStaticMethodsMethodToReturnArray() : array
    {
        return array_fill(0, rand(1, 100), rand(1, 100));
    }

    protected static function protectedStaticMethodsMethodToReturnBool() : bool
    {
        return (rand(0,1) === 1 ? true : false);
    }

    protected static function protectedStaticMethodsMethodToReturnClosure() : Closure
    {
        return function(): void {};
    }

    protected static function protectedStaticMethodsMethodToReturnInt() : int
    {
        return rand(1, 100);
    }

    protected static function protectedStaticMethodsMethodToReturnFloat() : float
    {
        return floatval(strval(rand(1, 10)) . strval(rand(1, 100)));
    }

    protected static function protectedStaticMethodsMethodToReturnNullableObject() : ?object
    {
        return (rand(0, 1) === 1 ? new \stdClass() : null);
    }

    protected static function protectedStaticMethodsMethodToReturnObject() : object
    {
        return new \stdClass();
    }

    protected static function protectedStaticMethodsMethodToReturnString() : string
    {
        return 'Foo bar baz';
    }

    public function callAll(): void
    {
        var_dump(
            $this->protectedStaticMethodsMethodToReturnArray(),
            $this->protectedStaticMethodsMethodToReturnBool(),
            $this->protectedStaticMethodsMethodToReturnClosure(),
            $this->protectedStaticMethodsMethodToReturnInt(),
            $this->protectedStaticMethodsMethodToReturnFloat(),
            $this->protectedStaticMethodsMethodToReturnNullableObject(),
            $this->protectedStaticMethodsMethodToReturnObject(),
            $this->protectedStaticMethodsMethodToReturnString(),
        );

    }

}
