<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PublicMethods class mocks a class that defines public
 * methods of various types.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class PublicMethods
{

    /**
     * @return array<int, int>
     */
    public function publicMethodsMethodToReturnArray() : array
    {
        return array_fill(0, rand(1, 100), rand(1, 100));
    }

    public function publicMethodsMethodToReturnBool() : bool
    {
        return (rand(0,1) === 1 ? true : false);
    }

    public function publicMethodsMethodToReturnClosure() : Closure
    {
        return function(): void {};
    }

    public function publicMethodsMethodToReturnInt() : int
    {
        return rand(1, 100);
    }

    public function publicMethodsMethodToReturnFloat() : float
    {
        return floatval(strval(rand(1, 10)) . strval(rand(1, 100)));
    }

    public function publicMethodsMethodToReturnNullableObject() : ?object
    {
        return (rand(0, 1) === 1 ? new \stdClass() : null);
    }

    public function publicMethodsMethodToReturnObject() : object
    {
        return new \stdClass();
    }

    public function publicMethodsMethodToReturnString() : string
    {
        return 'Foo bar baz';
    }

}
