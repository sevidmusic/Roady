<?php


namespace Extensions\Foo\core\classes\component;

use Extensions\Foo\core\abstractions\component\Foo as FooBase;
use Extensions\Foo\core\interfaces\component\Foo as FooInterface;

class Foo extends FooBase implements FooInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the FooBase class
     * fulfills the requirements of the FooInterface.
     */
}
