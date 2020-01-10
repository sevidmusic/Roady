<?php


namespace UnitTests\classes\component;


use DarlingCms\classes\component\Component;
use DarlingCms\classes\primary\Storable;
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