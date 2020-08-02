<?php


namespace Extensions\Contests\core\classes\component\Contest;

use Extensions\Contests\core\abstractions\component\Contest\User as UserBase;
use Extensions\Contests\core\interfaces\component\Contest\User as UserInterface;

class User extends UserBase implements UserInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the UserBase class
     * fulfills the requirements of the UserInterface.
     */
}