<?php

namespace UnitTests\abstractions\component\Factory;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use UnitTests\interfaces\component\Factory\TestTraits\OutputComponentFactoryTestTrait;

class OutputComponentFactoryTest extends CoreStoredComponentFactoryTest
{
    use OutputComponentFactoryTestTrait;

    public function setUp(): void
    {
        $this->setOutputComponentFactory(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Factory\OutputComponentFactory',
                [
                    $this->getMockPrimaryFactory(),
                    $this->getMockCrud(),
                    $this->getMockStoredComponentRegistry()
                ]
            )
        );
        $this->setOutputComponentFactoryParentTestInstances();
    }
}
