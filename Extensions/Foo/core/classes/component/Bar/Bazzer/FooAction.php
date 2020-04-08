<?php

namespace Extensions\Foo\core\classes\component\Bar\Bazzer;

use Extensions\Foo\core\interfaces\component\Bar\Bazzer\FooAction as FooActionInterface;
use Extensions\Foo\core\abstractions\component\Bar\Bazzer\FooAction as FooActionBase;

class FooAction extends FooActionBase implements FooActionInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the FooActionBase class
     * fulfills the requirements of the FooActionInterface.
     */
}
