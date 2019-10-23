<?php

use DarlingCms\abstractions\aggregate\StorableComponent;
use PHPUnit\Framework\MockObject\MockObject;

class StorableComponentTest extends ComponentTest
{
    /**
     * @var StorableComponent|MockObject PhpUnit mock object instance that represents
     *                           the DarlingCms\abstractions\aggregate\StorableComponent
     *                           abstract class that will be used for testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the DarlingCms\abstractions\aggregate\Component
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        $constructorArgs = ['ComponentName', 'ComponentType', 'ComponentLocation', 'ComponentContainer'];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\aggregate\StorableComponent', $constructorArgs);
    }

    public function testGetLocationReturnsNonEmptyString()
    {
        $this->isNonEmptyString($this->component->getLocation());
    }

    public function testGetContainerReturnsNonEmptyString()
    {
        $this->isNonEmptyString($this->component->getContainer());
    }
}
