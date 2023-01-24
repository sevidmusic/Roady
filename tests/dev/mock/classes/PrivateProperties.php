<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PrivateProperties class mocks a class that defines private
 * properties of various types, and public methods to return those
 * properties.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class PrivateProperties
{
    /**
     * @var array<int, int>
     */
    private array $privatePropertiesPrivateArray = [0, 1, 2];
    private bool $privatePropertiesPrivateBool = true;
    private ?Closure $privatePropertiesPrivateClosure = null;
    private float $privatePropertiesPrivateFloat = 0.0;
    private int $privatePropertiesPrivateInt = 0;
    private ?object $privatePropertiesPrivateNullableObject = null;
    private object $privatePropertiesPrivateObject;
    private string $privatePropertiesPrivateString = 'Foo Bar Baz';

    /**
     * @return array<int, int>
     */
    public function getPrivatePropertiesPrivateArray() : array
    {
        return $this->privatePropertiesPrivateArray;
    }

    public function getPrivatePropertiesPrivateBool() : bool
    {
        return $this->privatePropertiesPrivateBool;
    }

    public function getPrivatePropertiesPrivateClosure() : Closure
    {
        if(!isset($this->privatePropertiesPrivateClosure)) {
            $this->privatePropertiesPrivateClosure =
                function(): void {};
        }
        return $this->privatePropertiesPrivateClosure;
    }

    public function getPrivatePropertiesPrivateInt() : int
    {
        return $this->privatePropertiesPrivateInt;
    }

    public function getPrivatePropertiesPrivateFloat() : float
    {
        return $this->privatePropertiesPrivateFloat;
    }

    public function getPrivatePropertiesPrivateNullableObject() : ?object
    {
        return $this->privatePropertiesPrivateNullableObject;
    }

    public function getPrivatePropertiesPrivateObject() : object
    {
        if(!isset($this->privatePropertiesPrivateObject)) {
            $this->privatePropertiesPrivateObject =
                new \stdClass();
        }
        return $this->privatePropertiesPrivateObject;
    }

    public function getPrivatePropertiesPrivateString() : string
    {
        return $this->privatePropertiesPrivateString;
    }

}
