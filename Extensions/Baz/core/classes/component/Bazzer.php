<?php


namespace Extensions\Baz\core\classes\component;

use Extensions\Baz\core\abstractions\component\Bazzer as BazzerBase;
use Extensions\Baz\core\interfaces\component\Bazzer as BazzerInterface;

class Bazzer extends BazzerBase implements BazzerInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the BazzerBase class
     * fulfills the requirements of the BazzerInterface.
     */
}
