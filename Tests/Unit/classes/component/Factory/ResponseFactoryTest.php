<?php

namespace UnitTests\classes\component\Factory;

use DarlingDataManagementSystem\classes\component\Factory\ResponseFactory;
use UnitTests\abstractions\component\Factory\ResponseFactoryTest as CoreResponseFactoryTest;

class ResponseFactoryTest extends CoreResponseFactoryTest
{
    public function setUp(): void
    {
        $this->setResponseFactory(
            new ResponseFactory(
                $this->getMockPrimaryFactory(),
                $this->getMockCrud(),
                $this->getMockStoredComponentRegistry()
            )
        );
        $this->setResponseFactoryParentTestInstances();
    }
}