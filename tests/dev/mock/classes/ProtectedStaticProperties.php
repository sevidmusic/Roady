<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The ProtectedStaticProperties class mocks a class that defines
 * protected static properties of various types, and public static
 * methods to return those properties.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class ProtectedStaticProperties
{
    /**
     * @var array<int, int>
     */
    protected static array $protectedStaticPropertiesPrivateArray = [0, 1, 2];
    protected static bool $protectedStaticPropertiesPrivateBool = true;
    protected static ?Closure $protectedStaticPropertiesPrivateClosure = null;
    protected static float $protectedStaticPropertiesPrivateFloat = 0.0;
    protected static int $protectedStaticPropertiesPrivateInt = 0;
    protected static ?object $protectedStaticPropertiesPrivateNullableObject = null;
    protected static object $protectedStaticPropertiesPrivateObject;
    protected static string $protectedStaticPropertiesPrivateString = 'Foo Bar Baz';

    /**
     * @return array<int, int>
     */
    public static function getProtectedStaticPropertiesPrivateArray() : array
    {
        return self::$protectedStaticPropertiesPrivateArray;
    }

    public static function getProtectedStaticPropertiesPrivateBool() : bool
    {
        return self::$protectedStaticPropertiesPrivateBool;
    }

    public static function getProtectedStaticPropertiesPrivateClosure() : Closure
    {
        if(!isset(self::$protectedStaticPropertiesPrivateClosure)) {
            self::$protectedStaticPropertiesPrivateClosure =
                function(): void {};
        }
        return self::$protectedStaticPropertiesPrivateClosure;
    }

    public static function getProtectedStaticPropertiesPrivateInt() : int
    {
        return self::$protectedStaticPropertiesPrivateInt;
    }

    public static function getProtectedStaticPropertiesPrivateFloat() : float
    {
        return self::$protectedStaticPropertiesPrivateFloat;
    }

    public static function getProtectedStaticPropertiesPrivateNullableObject() : ?object
    {
        return self::$protectedStaticPropertiesPrivateNullableObject;
    }

    public static function getProtectedStaticPropertiesPrivateObject() : object
    {
        if(!isset(self::$protectedStaticPropertiesPrivateObject)) {
            self::$protectedStaticPropertiesPrivateObject =
                new \stdClass();
        }
        return self::$protectedStaticPropertiesPrivateObject;
    }

    public static function getProtectedStaticPropertiesPrivateString() : string
    {
        return self::$protectedStaticPropertiesPrivateString;
    }

}
