<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PublicMethods class mocks a class that defines public methods
 * of various types.
 *
 * This class should not be used in a production setting, it is meant
 * for testing only.
 *
 */
class PublicMethods
{

    /**
     * @param array<mixed> $parameterAcceptsArray
     * @return array<mixed>
     */
    public function publicMethodToReturnArray(
        array $parameterAcceptsArray
    ) : array
    {
        return $parameterAcceptsArray;
    }

    public function publicMethodToReturnBool(
        bool $parameterAcceptsBool
    ) : bool
    {
        return $parameterAcceptsBool;
    }

    public function publicMethodToReturnClosure(
        Closure $parameterAcceptsClosure
    ) : Closure
    {
        return $parameterAcceptsClosure;
    }

    public function publicMethodToReturnInt(
        int $parameterAcceptsInt
    ) : int
    {
        return $parameterAcceptsInt;
    }

    public function publicMethodToReturnFloat(
        float $parameterAcceptsFloat
    ) : float
    {
        return $parameterAcceptsFloat;
    }

    public function publicMethodToReturnObjectOrNull(
        ?object $parameterAcceptsObjectOrNull = null
    ) : ?object
    {
        return $parameterAcceptsObjectOrNull;
    }

    public function publicMethodToReturnObject(
        object $parameterAcceptsObject
    ) : object
    {
        return $parameterAcceptsObject;
    }

    public function publicMethodToReturnString(
        string $parameterAcceptsString
    ) : string
    {
        return $parameterAcceptsString;
    }

}
