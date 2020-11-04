<?php

namespace UnitTests\classes\component\UserInterface;

use DarlingDataManagementSystem\classes\component\UserInterface\ResponseUI as CoreResponseUI;
use UnitTests\abstractions\component\UserInterface\ResponseUITest as ResponseUITestBase;

class ResponseUITest extends ResponseUITestBase
{
    public function setUp(): void
    {
        $this->setResponseUI(
            new CoreResponseUI(
                ...$this->getResponseUITestArgs()
            )
        );
        $this->setResponseUIParentTestInstances();
    }
}
