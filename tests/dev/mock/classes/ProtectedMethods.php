<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The ProtectedMethods class mocks a class that defines protected
 * methods of various types, and a public method to call all of the
 * protected methods.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class ProtectedMethods
{

    /**
     * @return array<int, int>
     */
    protected function protectedMethodsMethodToReturnArray() : array
    {
        return array_fill(0, rand(1, 100), rand(1, 100));
    }

    protected function protectedMethodsMethodToReturnBool() : bool
    {
        return (rand(0,1) === 1 ? true : false);
    }

    protected function protectedMethodsMethodToReturnClosure() : Closure
    {
        return function(): void {};
    }

    protected function protectedMethodsMethodToReturnInt() : int
    {
        return rand(1, 100);
    }

    protected function protectedMethodsMethodToReturnFloat() : float
    {
        return floatval(strval(rand(1, 10)) . strval(rand(1, 100)));
    }

    protected function protectedMethodsMethodToReturnNullableObject() : ?object
    {
        return (rand(0, 1) === 1 ? new \stdClass() : null);
    }

    protected function protectedMethodsMethodToReturnObject() : object
    {
        return new \stdClass();
    }

    protected function protectedMethodsMethodToReturnString() : string
    {
        return 'Foo bar baz';
    }

    public function callAll(): void
    {
        var_dump(
            $this->protectedMethodsMethodToReturnArray(),
            $this->protectedMethodsMethodToReturnBool(),
            $this->protectedMethodsMethodToReturnClosure(),
            $this->protectedMethodsMethodToReturnInt(),
            $this->protectedMethodsMethodToReturnFloat(),
            $this->protectedMethodsMethodToReturnNullableObject(),
            $this->protectedMethodsMethodToReturnObject(),
            $this->protectedMethodsMethodToReturnString(),
        );

    }

}
