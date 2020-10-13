<?php

namespace UnitTests\abstractions\component\Driver\Storage;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Driver\Storage\FileSystem\JsonStorageDriverTest;
use UnitTests\interfaces\component\Driver\Storage\TestTraits\StandardTestTrait;

class StorageDriverTest extends JsonStorageDriverTest
{
    use StandardTestTrait;

    public function setUp(): void
    {
        $this->setStorageDriver(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Driver\Storage\StorageDriver',
                [
                    new Storable(
                        'MockStandardName',
                        'MockStandardLocation',
                        'MockStandardContainer'
                    ),
                    new Switchable()
                ]
            )
        );
        $this->setStorageDriverParentTestInstances();
    }

}
