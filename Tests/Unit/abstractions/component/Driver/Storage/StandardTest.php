<?php

namespace UnitTests\abstractions\component\Driver\Storage;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\Driver\Storage\FileSystem\JsonTest;
use UnitTests\interfaces\component\Driver\Storage\TestTraits\StandardTestTrait;

class StandardTest extends JsonTest
{
    use StandardTestTrait;

    public function setUp(): void
    {
        $this->setStandard(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Driver\Storage\Standard',
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
