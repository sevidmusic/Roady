<?php

namespace UnitTests\classes\component\Driver\Storage;

use DarlingDataManagementSystem\classes\component\Driver\Storage\StandardStorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Driver\Storage\StandardTest as AbstractStandardTest;

class StandardTest extends AbstractStandardTest
{
    public function setUp(): void
    {
        $this->setStandard(
            new StandardStorageDriver(
                new Storable(
                    'StandardName',
                    'StandardLocation',
                    'StandardContainer'
                ),
                new Switchable()
            )
        );
        $this->setStandardParentTestInstances();
    }
}
