<?php

namespace UnitTests\classes\component;

use DarlingDataManagementSystem\classes\component\Action;
use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\ActionTest as AbstractActionTest;

class ActionTest extends AbstractActionTest
{
    public function setUp(): void
    {
        $this->setAction(
            new Action(
                new Storable(
                    'ActionName',
                    'ActionLocation',
                    'ActionContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setActionParentTestInstances();
    }
}
