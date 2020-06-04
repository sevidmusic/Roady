<?php


namespace Extensions\Contests\core\classes\component\Contest;

use Extensions\Contests\core\abstractions\component\Contest\Submission as SubmissionBase;
use Extensions\Contests\core\interfaces\component\Contest\Submission as SubmissionInterface;

class Submission extends SubmissionBase implements SubmissionInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the SubmissionBase class
     * fulfills the requirements of the SubmissionInterface.
     */
}