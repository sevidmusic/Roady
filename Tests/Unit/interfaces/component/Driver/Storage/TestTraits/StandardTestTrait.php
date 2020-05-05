<?php

namespace UnitTests\interfaces\component\Driver\Storage\TestTraits;

use DarlingCms\abstractions\component\Driver\Storage\Standard;
use UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits\JsonTestTrait;

trait StandardTestTrait
{

    use JsonTestTrait;

    private $standard;

    protected function setStandardParentTestInstances(): void
    {
        $this->setJson($this->getStandard());
        $this->setJsonParentTestInstances();
        $this->setSwitchableComponent($this->getStandard());
        $this->setSwitchableComponentParentTestInstances();
    }

    public function getStandard(): Standard
    {
        return $this->standard;
    }

    public function setStandard(Standard $standard): void
    {
        $this->standard = $standard;
    }

}
