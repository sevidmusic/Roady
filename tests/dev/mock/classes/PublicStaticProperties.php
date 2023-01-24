<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PublicStaticProperties class mocks a class that defines
 * public static properties of various types.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class PublicStaticProperties
{
    /**
     * @var array<int, int>
     */
    public static array $publicStaticPropertiesPrivateArray = [0, 1, 2];
    public static bool $publicStaticPropertiesPrivateBool = true;
    public static ?Closure $publicStaticPropertiesPrivateClosure = null;
    public static float $publicStaticPropertiesPrivateFloat = 0.0;
    public static int $publicStaticPropertiesPrivateInt = 0;
    public static ?object $publicStaticPropertiesPrivateNullableObject = null;
    public static object $publicStaticPropertiesPrivateObject;
    public static string $publicStaticPropertiesPrivateString = 'Foo Bar Baz';

}
