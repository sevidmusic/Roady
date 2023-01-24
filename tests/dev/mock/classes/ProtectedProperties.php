<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The ProtectedProperties class mocks a class that defines protected
 * properties of various types, and public methods to return those
 * properties.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class ProtectedProperties
{
    /**
     * @var array<int, int>
     */
    protected array $protectedPropertiesProtectedArray = [0, 1, 2];
    protected bool $protectedPropertiesProtectedBool = true;
    protected ?Closure $protectedPropertiesProtectedClosure = null;
    protected float $protectedPropertiesProtectedFloat = 0.0;
    protected int $protectedPropertiesProtectedInt = 0;
    protected ?object $protectedPropertiesProtectedNullableObject = null;
    protected object $protectedPropertiesProtectedObject;
    protected string $protectedPropertiesProtectedString = 'Foo Bar Baz';

    /**
     * @return array<int, int>
     */
    public function getProtectedPropertiesProtectedArray() : array
    {
        return $this->protectedPropertiesProtectedArray;
    }

    public function getProtectedPropertiesProtectedBool() : bool
    {
        return $this->protectedPropertiesProtectedBool;
    }

    public function getProtectedPropertiesProtectedClosure() : Closure
    {
        if(!isset($this->protectedPropertiesProtectedClosure)) {
            $this->protectedPropertiesProtectedClosure =
                function(): void {};
        }
        return $this->protectedPropertiesProtectedClosure;
    }

    public function getProtectedPropertiesProtectedInt() : int
    {
        return $this->protectedPropertiesProtectedInt;
    }

    public function getProtectedPropertiesProtectedFloat() : float
    {
        return $this->protectedPropertiesProtectedFloat;
    }

    public function getProtectedPropertiesProtectedNullableObject() : ?object
    {
        return $this->protectedPropertiesProtectedNullableObject;
    }

    public function getProtectedPropertiesProtectedObject() : object
    {
        if(!isset($this->protectedPropertiesProtectedObject)) {
            $this->protectedPropertiesProtectedObject =
                new \stdClass();
        }
        return $this->protectedPropertiesProtectedObject;
    }

    public function getProtectedPropertiesProtectedString() : string
    {
        return $this->protectedPropertiesProtectedString;
    }

}
