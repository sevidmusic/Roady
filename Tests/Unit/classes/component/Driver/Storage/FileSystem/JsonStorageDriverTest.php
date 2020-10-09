<?php

namespace UnitTests\classes\component\Driver\Storage\FileSystem;

use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as CoreJsonStorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use UnitTests\abstractions\component\Driver\Storage\FileSystem\JsonStorageDriverTest as JsonStorageDriverTestBase;

class JsonStorageDriverTest extends JsonStorageDriverTestBase
{
    public function setUp(): void
    {
        $this->setJsonStorageDriver(
            new CoreJsonStorageDriver(
                ...$this->getTestInstanceArgs()
            )
        );
        $this->setJsonParentTestInstances();
    }
}
