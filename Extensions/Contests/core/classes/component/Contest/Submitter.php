<?php


namespace Extensions\Contests\core\classes\component\Contest;

use Extensions\Contests\core\interfaces\component\Contest\Submitter as SubmitterInterface;
use Extensions\Contests\core\abstractions\component\Contest\Submitter as SubmitterBase;

class Submitter extends SubmitterBase implements SubmitterInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the SubmitterBase class
     * fulfills the requirements of the SubmitterInterface.
     */
}