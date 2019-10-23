<?php

use DarlingCms\abstractions\aggregate\Component;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class ComponentTest. Defines tests for the DarlingCms\abstractions\aggregate\Component abstract class.
 */
class ComponentTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var Component|MockObject PhpUnit mock object instance that represents
     *                           the DarlingCms\abstractions\aggregate\Component
     *                           abstract class that will be used for testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the DarlingCms\abstractions\aggregate\Component
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        $constructorArgs = ['ComponentName', 'ComponentType'];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\aggregate\Component', $constructorArgs);
    }

    /**
     * Test that the getName() method returns a non empty string.
     */
    public function testGetNameReturnsNonEmptyString()
    {
        $this->assertIsString($this->component->getName());
        $this->assertNotEmpty($this->component->getName());
    }

    /**
     * Test that the getUniqueId() method returns a non empty string.
     */
    public function testGetUniqueIdReturnsNonEmptyString()
    {
        $this->assertIsString($this->component->getUniqueId());
        $this->assertNotEmpty($this->component->getUniqueId());
    }

    /**
     * Test that the getType() method returns a non empty string.
     */
    public function testGetTypeReturnsNonEmptyString()
    {
        $this->assertIsString($this->component->getType());
        $this->assertNotEmpty($this->component->getType());
    }
}
