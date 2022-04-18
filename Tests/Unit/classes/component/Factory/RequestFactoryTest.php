<?php

namespace UnitTests\classes\component\Factory;

use roady\classes\component\Factory\RequestFactory;
use UnitTests\abstractions\component\Factory\RequestFactoryTest as CoreRequestFactoryTest;

class RequestFactoryTest extends CoreRequestFactoryTest
{
    public function setUp(): void
    {
        $this->setRequestFactory(
            new RequestFactory(
                $this->getMockPrimaryFactory(),
                $this->getMockCrud(),
                $this->getMockStoredComponentRegistry()
            )
        );
        $this->setRequestFactoryParentTestInstances();
    }
}
