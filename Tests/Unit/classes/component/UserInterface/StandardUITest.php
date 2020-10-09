<?php

namespace UnitTests\classes\component\UserInterface;

use DarlingDataManagementSystem\classes\component\UserInterface\StandardUI;
use UnitTests\abstractions\component\UserInterface\StandardUITest as AbstractStandardUITest;

class StandardUITest extends AbstractStandardUITest
{
    public function setUp(): void
    {
        $this->setStandardUI(
            new StandardUI(
                ...$this->getTestInstanceArgs()
            )
        );
        $this->setStandardUIParentTestInstances();
        $this->generateStoredTestComponents();
    }
}
