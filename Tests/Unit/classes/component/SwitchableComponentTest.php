<?php

namespace UnitTests\classes\component;

use DarlingDataManagementSystem\classes\component\SwitchableComponent;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest as AbstractSwitchableComponentTest;

class SwitchableComponentTest extends AbstractSwitchableComponentTest
{
    public function setUp(): void
    {
        $this->setSwitchableComponent(
            new SwitchableComponent(
                new Storable(
                    'SwitchableComponentName',
                    'SwitchableComponentLocation',
                    'SwitchableComponentContainer'
                ),
                new Switchable()
            )
        );
        $this->setSwitchableComponentParentTestInstances();
    }
}