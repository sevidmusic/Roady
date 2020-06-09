<?php

namespace Extensions\Contests\core\abstractions\component\Contest;

use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DateTime;
use Extensions\Contests\core\classes\component\Contest\Submitter;
use Extensions\Contests\core\interfaces\component\Contest\Submission as SubmissionInterface;
use RuntimeException;

abstract class Submission extends CoreOutputComponent implements SubmissionInterface
{

    private const DEFAULT_OUTPUT_SPRINT = 'Submission Name: %s | Submission Id: %s | Submission Timestamp: %s';
    private const ERROR_MALFORMED_URL = 'Warning: Submission "%s" with id "%s" is assigned a malformed url "%s"';
    private $submitter;
    private $url;
    private $dateTimeOfSubmission;
    private $metaData = [];

    public function __construct(
        Storable $storable,
        Switchable $switchable,
        Positionable $positionable,
        Submitter $submitter,
        string $url
    )
    {
        $this->dateTimeOfSubmission = new DateTime('now');
        $this->url = $url;
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

    public function getUrl(): string
    {
        if ($this->urlIsProperlyFormatted() === false) {
            throw new RuntimeException(sprintf(self::ERROR_MALFORMED_URL, $this->getName(), $this->getUniqueId(), $this->url));
        }
        return $this->url;
    }

    private function urlIsProperlyFormatted(): bool
    {
        return 1 === preg_match("/\b(?:(?:https?):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->url);
    }

}
