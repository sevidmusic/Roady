<?php

namespace UnitTests\classes\component;

use roady\classes\component\SwitchableComponent;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
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