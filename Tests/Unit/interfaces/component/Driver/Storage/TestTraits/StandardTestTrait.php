<?php

namespace UnitTests\interfaces\component\Driver\Storage\TestTraits;

use DarlingDataManagementSystem\abstractions\component\Driver\Storage\StandardStorageDriver;
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

    public function getStandard(): StandardStorageDriver
    {
        return $this->standard;
    }

    public function setStandard(StandardStorageDriver $standard): void
    {
        $this->standard = $standard;
    }

}
