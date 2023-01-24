<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PrivateMethods class mocks a class that defines private
 * methods of various types, and a public method to call all
 * of the private methods.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class PrivateMethods
{

    /**
     * @return array<int, int>
     */
    private function privateMethodsMethodToReturnArray() : array
    {
        return array_fill(0, rand(1, 100), rand(1, 100));
    }

    private function privateMethodsMethodToReturnBool() : bool
    {
        return (rand(0,1) === 1 ? true : false);
    }

    private function privateMethodsMethodToReturnClosure() : Closure
    {
        return function(): void {};
    }

    private function privateMethodsMethodToReturnInt() : int
    {
        return rand(1, 100);
    }

    private function privateMethodsMethodToReturnFloat() : float
    {
        return floatval(strval(rand(1, 10)) . strval(rand(1, 100)));
    }

    private function privateMethodsMethodToReturnNullableObject() : ?object
    {
        return (rand(0, 1) === 1 ? new \stdClass() : null);
    }

    private function privateMethodsMethodToReturnObject() : object
    {
        return new \stdClass();
    }

    private function privateMethodsMethodToReturnString() : string
    {
        return 'Foo bar baz';
    }

    public function callAll(): void
    {
        var_dump(
            $this->privateMethodsMethodToReturnArray(),
            $this->privateMethodsMethodToReturnBool(),
            $this->privateMethodsMethodToReturnClosure(),
            $this->privateMethodsMethodToReturnInt(),
            $this->privateMethodsMethodToReturnFloat(),
            $this->privateMethodsMethodToReturnNullableObject(),
            $this->privateMethodsMethodToReturnObject(),
            $this->privateMethodsMethodToReturnString(),
        );

    }

}
