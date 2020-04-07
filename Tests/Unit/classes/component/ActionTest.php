<?php

namespace UnitTests\classes\component;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\component\Action;
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
