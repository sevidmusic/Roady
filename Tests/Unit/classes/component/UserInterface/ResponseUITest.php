<?php

namespace UnitTests\classes\component\UserInterface;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\component\UserInterface\ResponseUI;
use UnitTests\abstractions\component\UserInterface\ResponseUITest as AbstractResponseUITest;

class ResponseUITest extends AbstractResponseUITest
{
    public function setUp(): void
    {
        $this->setResponseUI(
            new ResponseUI(
                new Storable(
                    'ResponseUIName',
                    'ResponseUILocation',
                    'ResponseUIContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setResponseUIParentTestInstances();
    }
}