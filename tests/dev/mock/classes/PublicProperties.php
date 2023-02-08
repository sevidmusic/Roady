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
    public array $publicPropertyAcceptsArray = [0, 1, 2];
    public bool $publicPropertyAcceptsBool = true;
    public ?Closure $publicPropertyAcceptsClosureOrNull = null;
    public float $publicPropertyAcceptsFloat = 0.0;
    public int $publicPropertyAcceptsInt = 0;
    public ?object $publicPropertyAcceptsObjectOrNull = null;
    public object $publicPropertyAcceptsObject;
    public string $publicPropertyAcceptsString = 'Foo Bar Baz';

}
