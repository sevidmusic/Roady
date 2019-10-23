<?php

use DarlingCms\abstractions\aggregate\SwitchableComponent;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class SwitchableComponentTest. Defines tests for the DarlingCms\abstractions\aggregate\SwitchableComponent
 * abstract class.
 */
class SwitchableComponentTest extends StorableComponentTest
{

    /**
     * @var SwitchableComponent|MockObject PhpUnit mock object instance that represents
     *                                     the DarlingCms\abstractions\aggregate\SwitchableComponent
     *                                     abstract class that will be used for testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the DarlingCms\abstractions\aggregate\SwitchableComponent
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        $constructorArgs = ['ComponentName', 'ComponentType', 'ComponentLocation', 'ComponentContainer', false];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\aggregate\SwitchableComponent', $constructorArgs);
    }

    /**
     * Test that the getState() method returns a boolean.
     */
    public function testGetStateReturnsBool()
    {
        $this->assertIsBool($this->component->getState());
    }

    /**
     * Test that the switchState() method actually switches the state.
     */
    public function testCanSwitchState()
    {
        $initialState = $this->component->getState();
        $this->assertTrue($this->component->switchState());
        $this->assertNotEquals($initialState, $this->component->getState());
    }

}
