<?php

namespace UnitTests\abstractions\component\Driver\Storage\FileSystem;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Driver\Storage\FileSystem\TestTraits\JsonStorageDriverTestTrait;
use DarlingDataManagementSystem\abstractions\component\Driver\Storage\FileSystem\JsonStorageDriver as JsonStorageDriverBase;

class JsonStorageDriverTest extends SwitchableComponentTest
{
    use JsonStorageDriverTestTrait;

    public function setUp(): void
    {
        $this->setJsonStorageDriver(
            $this->getMockForAbstractClass(
                JsonStorageDriverBase::class,
                $this->getTestInstanceArgs()
            )
        );
        $this->setJsonParentTestInstances();
    }

}
