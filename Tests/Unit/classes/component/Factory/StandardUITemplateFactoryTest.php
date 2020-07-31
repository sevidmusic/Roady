<?php

namespace UnitTests\classes\component\Factory;

use DarlingDataManagementSystem\classes\component\Factory\StandardUITemplateFactory;
use UnitTests\abstractions\component\Factory\StandardUITemplateFactoryTest as CoreStandardUITemplateFactoryTest;

class StandardUITemplateFactoryTest extends CoreStandardUITemplateFactoryTest
{
    public function setUp(): void
    {
        $this->setStandardUITemplateFactory(
            new StandardUITemplateFactory(
                $this->getMockPrimaryFactory(),
                $this->getMockCrud(),
                $this->getMockStoredComponentRegistry()
            )
        );
        $this->setStandardUITemplateFactoryParentTestInstances();
    }
}