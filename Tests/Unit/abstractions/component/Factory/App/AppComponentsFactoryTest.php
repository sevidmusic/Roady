<?php

namespace UnitTests\abstractions\component\Factory\App;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use UnitTests\interfaces\component\Factory\App\TestTraits\AppComponentsFactoryTestTrait;

class AppComponentsFactoryTest extends CoreStoredComponentFactoryTest
{
    use AppComponentsFactoryTestTrait;

    public function setUp(): void
    {
        $this->setAppComponentsFactory(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Factory\App\AppComponentsFactory',
                [
                    $this->getMockPrimaryFactory(),
                    $this->getMockCrud(),
                    $this->getMockStoredComponentRegistry()
                ]
            )
        );
        $this->setAppComponentsFactoryParentTestInstances();
    }
}