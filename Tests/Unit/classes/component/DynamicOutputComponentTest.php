<?php

namespace UnitTests\classes\component;

use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\component\DynamicOutputComponent;
use UnitTests\abstractions\component\DynamicOutputComponentTest as AbstractDynamicOutputComponentTest;

class DynamicOutputComponentTest extends AbstractDynamicOutputComponentTest
{
    public function setUp(): void
    {
        $this->setDynamicOutputComponent(
            new DynamicOutputComponent(
                new Storable(
                    'DynamicOutputComponentName',
                    'DynamicOutputComponentLocation',
                    'DynamicOutputComponentContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setDynamicOutputComponentParentTestInstances();
    }
}