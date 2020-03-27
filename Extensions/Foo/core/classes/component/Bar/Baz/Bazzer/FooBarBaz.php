<?php

namespace Extensions\Foo\core\classes\component\Bar\Baz\Bazzer;

use Extensions\Foo\core\abstractions\component\Bar\Baz\Bazzer\FooBarBaz as FooBarBazBase;
use Extensions\Foo\core\interfaces\component\Bar\Baz\Bazzer\FooBarBaz as FooBarBazInterface;

class FooBarBaz extends FooBarBazBase implements FooBarBazInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the FooBarBazBase class
     * fulfills the requirements of the FooBarBazInterface.
     */
}
