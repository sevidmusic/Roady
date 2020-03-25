<?php


namespace Extensions\Foo\core\classes\component\Bazzer;

use Extensions\Foo\core\abstractions\component\Bazzer\Bar as BarBase;
use Extensions\Foo\core\interfaces\component\Bazzer\Bar as BarInterface;

class Bar extends BarBase implements BarInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the BarBase class
     * fulfills the requirements of the BarInterface.
     */
}
