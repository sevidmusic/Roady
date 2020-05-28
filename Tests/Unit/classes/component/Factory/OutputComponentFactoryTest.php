<?php

namespace UnitTests\classes\component\Factory;

use DarlingCms\classes\component\Factory\OutputComponentFactory;
use UnitTests\abstractions\component\Factory\OutputComponentFactoryTest as CoreOutputComponentFactoryTest;

class OutputComponentFactoryTest extends CoreOutputComponentFactoryTest
{
    public function setUp(): void
    {
        $this->setOutputComponentFactory(
            new OutputComponentFactory(
                $this->getMockPrimaryFactory(),
                $this->getMockCrud(),
                $this->getMockStoredComponentRegistry()
            )
        );
        $this->setOutputComponentFactoryParentTestInstances();
    }
}