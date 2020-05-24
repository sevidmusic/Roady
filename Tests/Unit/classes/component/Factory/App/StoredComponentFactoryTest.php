<?php

namespace UnitTests\classes\component\Factory\App;

use DarlingCms\classes\component\Factory\App\StoredComponentFactory;
use UnitTests\abstractions\component\Factory\App\StoredComponentFactoryTest as AbstractStoredComponentFactoryTest;

class StoredComponentFactoryTest extends AbstractStoredComponentFactoryTest
{
    public function setUp(): void
    {
        $this->setStoredComponentFactory(
            new StoredComponentFactory(
                $this->getMockPrimaryFactory(),
                $this->getMockCrud()
            )
        );
        $this->setStoredComponentFactoryParentTestInstances();
    }
}
