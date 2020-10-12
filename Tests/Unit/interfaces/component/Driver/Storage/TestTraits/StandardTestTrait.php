<?php

namespace UnitTests\interfaces\component\Driver\Storage\TestTraits;

use DarlingDataManagementSystem\abstractions\component\Driver\Storage\StorageDriver;
use UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits\JsonStorageDriverTestTrait;

trait StandardTestTrait
{

    use JsonStorageDriverTestTrait;

    private $standard;

    protected function setStandardParentTestInstances(): void
    {
        $this->setJsonStorageDriver($this->getStandard());
        $this->setJsonParentTestInstances();
        $this->setSwitchableComponent($this->getStandard());
        $this->setSwitchableComponentParentTestInstances();
    }

    public function getStandard(): StorageDriver
    {
        return $this->standard;
    }

    public function setStandard(StorageDriver $standard): void
    {
        $this->standard = $standard;
    }

}
