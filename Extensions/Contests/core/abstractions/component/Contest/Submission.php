<?php

namespace Extensions\Contests\core\abstractions\component\Contest;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use Extensions\Contests\core\interfaces\component\Contest\Submission as SubmissionInterface;
use Extensions\Contests\core\classes\component\Contest\Submitter;

abstract class Submission extends CoreOutputComponent implements SubmissionInterface
{

    private $submitter;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, Submitter $submitter)
    {
        $this->submitter = $submitter;
        parent::__construct($storable, $switchable, $positionable);
    }

}
