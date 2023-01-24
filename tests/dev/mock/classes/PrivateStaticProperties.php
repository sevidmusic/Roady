<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PrivateStaticProperties class mocks a class that defines
 * private static properties of various types, and public static
 * methods to return those properties.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class PrivateStaticProperties
{
    /**
     * @var array<int, int>
     */
    private static array $privateStaticPropertiesPrivateArray = [0, 1, 2];
    private static bool $privateStaticPropertiesPrivateBool = true;
    private static ?Closure $privateStaticPropertiesPrivateClosure = null;
    private static float $privateStaticPropertiesPrivateFloat = 0.0;
    private static int $privateStaticPropertiesPrivateInt = 0;
    private static ?object $privateStaticPropertiesPrivateNullableObject = null;
    private static object $privateStaticPropertiesPrivateObject;
    private static string $privateStaticPropertiesPrivateString = 'Foo Bar Baz';

    /**
     * @return array<int, int>
     */
    public static function getPrivateStaticPropertiesPrivateArray() : array
    {
        return self::$privateStaticPropertiesPrivateArray;
    }

    public static function getPrivateStaticPropertiesPrivateBool() : bool
    {
        return self::$privateStaticPropertiesPrivateBool;
    }

    public static function getPrivateStaticPropertiesPrivateClosure() : Closure
    {
        if(!isset(self::$privateStaticPropertiesPrivateClosure)) {
            self::$privateStaticPropertiesPrivateClosure =
                function(): void {};
        }
        return self::$privateStaticPropertiesPrivateClosure;
    }

    public static function getPrivateStaticPropertiesPrivateInt() : int
    {
        return self::$privateStaticPropertiesPrivateInt;
    }

    public static function getPrivateStaticPropertiesPrivateFloat() : float
    {
        return self::$privateStaticPropertiesPrivateFloat;
    }

    public static function getPrivateStaticPropertiesPrivateNullableObject() : ?object
    {
        return self::$privateStaticPropertiesPrivateNullableObject;
    }

    public static function getPrivateStaticPropertiesPrivateObject() : object
    {
        if(!isset(self::$privateStaticPropertiesPrivateObject)) {
            self::$privateStaticPropertiesPrivateObject =
                new \stdClass();
        }
        return self::$privateStaticPropertiesPrivateObject;
    }

    public static function getPrivateStaticPropertiesPrivateString() : string
    {
        return self::$privateStaticPropertiesPrivateString;
    }

}
