<?php

namespace UnitTests\classes\component\Factory\App;

use DarlingCms\classes\component\Factory\App\AppComponentsFactory;
use UnitTests\abstractions\component\Factory\App\AppComponentsFactoryTest as CoreAppComponentsFactoryTest;

class AppComponentsFactoryTest extends CoreAppComponentsFactoryTest
{
    public function setUp(): void
    {
        $this->setAppComponentsFactory(
            new AppComponentsFactory(
                $this->getMockPrimaryFactory(),
                $this->getMockCrud(),
                $this->getMockStoredComponentRegistry()
            )
        );
        $this->setAppComponentsFactoryParentTestInstances();
    }
}