<?php

namespace UnitTests\classes\component\Driver\Storage;

use roady\classes\component\Driver\Storage\StorageDriver;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use UnitTests\abstractions\component\Driver\Storage\StorageDriverTest as AbstractStandardTest;

class StorageDriverTest extends AbstractStandardTest
{
    public function setUp(): void
    {
        $this->setStorageDriver(
            new StorageDriver(
                new Storable(
                    'StorageDriverTestStandardName',
                    'StorageDriverTestStandardLocation',
                    'StorageDriverTestStandardContainer'
                ),
                new Switchable()
            )
        );
        $this->setStorageDriverParentTestInstances();
    }
}
