<?php

namespace Extensions\Contests\core\abstractions\component\Contest;

use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use Extensions\Contests\core\classes\component\Contest\Submitter;
use Extensions\Contests\core\interfaces\component\Contest\Submission as SubmissionInterface;
use RuntimeException;

abstract class Submission extends CoreOutputComponent implements SubmissionInterface
{

    private $submitter;
    private $pathToSubmittedFile;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, Submitter $submitter, string $pathToSubmittedFile)
    {
        if (!file_exists($pathToSubmittedFile)) {
            throw new RuntimeException();
        }
        $this->pathToSubmittedFile = $pathToSubmittedFile;
        $this->submitter = $submitter;
        parent::__construct($storable, $switchable, $positionable);
    }

    public function getSubmitter(): Submitter
    {
        return $this->submitter;
    }
}
