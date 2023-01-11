<?php

namespace tests\dev\mock\classes;

use tests\dev\mock\classes\ReflectedSubParentClass;
use \Closure;
use \stdClass;
/**
 * This class is only intended to be used in tests.
 *
 * It has no other purpose.
 *
 */

final class ReflectedClass extends ReflectedSubParentClass
{
    private string $reflectedClassProperty = 'Foo bar bazz bazzer';


    public function reflectedClassProperty(): string
    {
        return $this->reflectedClassProperty;
    }

}
