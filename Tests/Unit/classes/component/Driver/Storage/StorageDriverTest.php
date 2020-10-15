<?php

namespace UnitTests\classes\component\Driver\Storage;

use DarlingDataManagementSystem\classes\component\Driver\Storage\StorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Driver\Storage\StorageDriverTest as AbstractStandardTest;

class StorageDriverTest extends AbstractStandardTest
{
    public function setUp(): void
    {
        $this->setStorageDriver(
            new StorageDriver(
                new Storable(
                    'StandardName',
                    'StandardLocation',
                    'StandardContainer'
                ),
                new Switchable()
            )
        );
        $this->setStorageDriverParentTestInstances();
    }
}
