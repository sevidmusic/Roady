<?php

namespace UnitTests\classes\component;

use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\OutputComponentTest as AbstractOutputComponentTest;

class OutputComponentTest extends AbstractOutputComponentTest
{
    public function setUp(): void
    {
        $this->setOutputComponent(
            new OutputComponent(
                new Storable(
                    'OutputComponentName',
                    'OutputComponentLocation',
                    'OutputComponentContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setOutputComponentParentTestInstances();
    }
}
