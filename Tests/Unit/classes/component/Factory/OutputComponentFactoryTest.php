<?php

namespace UnitTests\classes\component\Factory;

use DarlingDataManagementSystem\classes\component\Factory\OutputComponentFactory;
use UnitTests\abstractions\component\Factory\OutputComponentFactoryTest as CoreOutputComponentFactoryTest;

class OutputComponentFactoryTest extends CoreOutputComponentFactoryTest
{
    public function setUp(): void
    {
        $this->setOutputComponentFactory(
            new OutputComponentFactory(
                ...$this->getOutputComponentFactoryTestArgs()
            )
        );
        $this->setOutputComponentFactoryParentTestInstances();
    }
}
