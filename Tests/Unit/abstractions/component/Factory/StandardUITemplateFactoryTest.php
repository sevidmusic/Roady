<?php

namespace UnitTests\abstractions\component\Factory;

use UnitTests\abstractions\component\Factory\StoredComponentFactoryTest as CoreStoredComponentFactoryTest;
use UnitTests\interfaces\component\Factory\TestTraits\StandardUITemplateFactoryTestTrait;

class StandardUITemplateFactoryTest extends CoreStoredComponentFactoryTest
{
    use StandardUITemplateFactoryTestTrait;

    public function setUp(): void
    {
        $this->setStandardUITemplateFactory(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\Factory\StandardUITemplateFactory',
                [
                    $this->getMockPrimaryFactory(),
                    $this->getMockCrud(),
                    $this->getMockStoredComponentRegistry()
                ]
            )
        );
        $this->setStandardUITemplateFactoryParentTestInstances();
    }
}