<?php

namespace UnitTests\abstractions\aggregate;

use DarlingCms\abstractions\aggregate\SwitchableComponent;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionMethod;

/**
 * Class SwitchableComponentTest. Defines tests for the
 * DarlingCms\abstractions\aggregate\SwitchableComponent abstract class.
 */
class SwitchableComponentTest extends StorableComponentTest
{
    /**
     * @var SwitchableComponent|MockObject PhpUnit mock object
     *                           instance that represents
     *                           the DarlingCms\abstractions\aggregate\SwitchableComponent
     *                           abstract class implementation that will
     *                           be used for testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the
     * DarlingCms\abstractions\aggregate\SwitchableComponent
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        $constructorArgs = ['ComponentName', 'ComponentLocation', 'ComponentContainer', true];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\aggregate\SwitchableComponent', $constructorArgs);
    }

    /**
     * Assert that the getState() method returns a boolean value.
     */
    public function testGetStateReturnsBooleanValue() {
        $this->assertIsBool($this->component->getState());
    }

    /**
     * Assert that the switchState() method can
     * switch the state.
     */
    public function testCanSwitchState() {
        $initialState = $this->component->getState();
        $this->assertTrue($this->component->switchState());
        $this->assertNotEquals($initialState, $this->component->getState());
    }

}
