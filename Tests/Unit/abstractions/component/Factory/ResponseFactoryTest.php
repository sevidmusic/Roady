<?php

namespace UnitTests\abstractions\component\Factory;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use UnitTests\interfaces\component\Factory\TestTraits\ResponseFactoryTestTrait;

class ResponseFactoryTest extends CoreStoredComponentFactoryTest
{
    use ResponseFactoryTestTrait;

    public function setUp(): void
    {
        $this->setResponseFactory(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Factory\ResponseFactory',
                [
                    $this->getMockPrimaryFactory(),
                    $this->getMockCrud(),
                    $this->getMockStoredComponentRegistry()
                ]
            )
        );
        $this->setResponseFactoryParentTestInstances();
    }
}