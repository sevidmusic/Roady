<?php

namespace UnitTests\classes\component\Factory;

use DarlingCms\classes\component\Factory\StoredComponentFactory;
use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as AbstractStoredComponentFactoryTest;

class StoredComponentFactoryTest extends AbstractStoredComponentFactoryTest
{
    public function setUp(): void
    {
        $this->setStoredComponentFactory(
            new StoredComponentFactory(
                $this->getMockPrimaryFactory(),
                $this->getMockCrud(),
                $this->getMockStoredComponentRegistry()
            )
        );
        $this->setStoredComponentFactoryParentTestInstances();
    }
}
