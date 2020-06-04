<?php

namespace Extensions\Contests\Tests\Unit\interfaces\component\Contest\TestTraits;

use Extensions\Contests\core\interfaces\component\Contest\Submitter;

trait SubmitterTestTrait
{

    private $submitter;

    protected function setSubmitterParentTestInstances(): void
    {
        $this->setComponent($this->getSubmitter());
        $this->setComponentParentTestInstances();
    }

    public function getSubmitter(): Submitter
    {
        return $this->submitter;
    }

    public function setSubmitter(Submitter $submitter)
    {
        $this->submitter = $submitter;
    }

}