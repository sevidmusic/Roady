<?php

namespace UnitTests\classes\component;

use DarlingCms\classes\component\SwitchableComponent;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
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