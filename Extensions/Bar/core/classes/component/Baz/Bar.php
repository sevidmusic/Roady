<?php


namespace Extensions\Bar\core\classes\component\Baz;

use Extensions\Bar\core\abstractions\component\Baz\Bar as BarBase;
use Extensions\Bar\core\interfaces\component\Baz\Bar as BarInterface;

class Bar extends BarBase implements BarInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the BarBase class
     * fulfills the requirements of the BarInterface.
     */
}
