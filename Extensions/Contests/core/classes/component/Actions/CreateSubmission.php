<?php

namespace Extensions\Contests\core\classes\component\Actions;

use Extensions\Contests\core\interfaces\component\Actions\CreateSubmission as CreateSubmissionInterface;
use Extensions\Contests\core\abstractions\component\Actions\CreateSubmission as CreateSubmissionBase;

class CreateSubmission extends CreateSubmissionBase implements CreateSubmissionInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the CreateSubmissionBase class
     * fulfills the requirements of the CreateSubmissionInterface.
     */
}