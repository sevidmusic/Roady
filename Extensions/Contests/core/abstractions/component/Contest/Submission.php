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

    private const DEFAULT_OUTPUT_SPRINT = 'Submission Name: %s | Submission Id: %s | Submission Timestamp: %s';
    private $submitter;
    private $pathToSubmittedFile;
    private $dateTimeOfSubmission;
    private $metaData = [];

    public function __construct(
        Storable $storable,
        Switchable $switchable,
        Positionable $positionable,
        Submitter $submitter,
        string $pathToSubmittedFile
    )
    {
        if (!file_exists($pathToSubmittedFile)) {
            throw new RuntimeException();
        }
        $this->dateTimeOfSubmission = new \DateTime('now');
        $this->pathToSubmittedFile = $pathToSubmittedFile;
        $this->submitter = $submitter;
        parent::__construct($storable, $switchable, $positionable);
    }

    public function getSubmitter(): Submitter
    {
        return $this->submitter;
    }

    public function assignMetaData(string $key, $value): void
    {
        $this->metaData[$key] = $value;
    }

    public function getOutput(): string
    {
        return (
            $this->getState() === false
            ? ''
            : sprintf(
                self::DEFAULT_OUTPUT_SPRINT,
                $this->getName(),
                $this->getUniqueId(),
                $this->dateTimeOfSubmission->getTimestamp()
            )
        );
    }

}
