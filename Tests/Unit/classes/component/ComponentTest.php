<?php


namespace UnitTests\classes\component;


use roady\classes\component\Component;
use roady\classes\primary\Storable;
use UnitTests\abstractions\component\ComponentTest as AbstractComponentTest;

class ComponentTest extends AbstractComponentTest
{
    public function setUp(): void
    {
        $this->setComponent(
            new Component(
                new Storable(
                    'ComponentName',
                    'ComponentLocation',
                    'ComponentContainer'
                )
            )
        );
        $this->setComponentParentTestInstances();
    }
}