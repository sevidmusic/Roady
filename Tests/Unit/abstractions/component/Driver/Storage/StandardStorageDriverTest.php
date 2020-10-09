<?php

namespace UnitTests\abstractions\component\Driver\Storage;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Driver\Storage\FileSystem\JsonStorageDriverTest;
use UnitTests\interfaces\component\Driver\Storage\TestTraits\StandardTestTrait;

class StandardStorageDriverTest extends JsonStorageDriverTest
{
    use StandardTestTrait;

    public function setUp(): void
    {
        $this->setStandard(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Driver\Storage\StandardStorageDriver',
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
        $this->setStandardParentTestInstances();
    }

}
