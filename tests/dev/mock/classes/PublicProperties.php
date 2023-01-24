<?php

namespace tests\dev\mock\classes;

use \Closure;

/**
 * The PublicProperties class mocks a class that defines public
 * properties of various types.
 *
 * This class should not be used in a production setting, it is
 * meant for testing only.
 *
 */
class PublicProperties
{
    /**
     * @var array<int, int>
     */
    public array $publicPropertiesPublicArray = [0, 1, 2];
    public bool $publicPropertiesPublicBool = true;
    public ?Closure $publicPropertiesPublicClosure = null;
    public float $publicPropertiesPublicFloat = 0.0;
    public int $publicPropertiesPublicInt = 0;
    public ?object $publicPropertiesPublicNullableObject = null;
    public object $publicPropertiesPublicObject;
    public string $publicPropertiesPublicString = 'Foo Bar Baz';

}
