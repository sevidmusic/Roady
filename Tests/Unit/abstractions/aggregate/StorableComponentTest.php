<?php

namespace UnitTests\abstractions\aggregate;

use DarlingCms\abstractions\aggregate\StorableComponent;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionMethod;

/**
 * Class StorableComponentTest. Defines tests for the
 * DarlingCms\abstractions\aggregate\StorableComponent abstract class.
 */
class StorableComponentTest extends ComponentTest
{
    /**
     * @var StorableComponent|MockObject PhpUnit mock object
     *                           instance that represents
     *                           the DarlingCms\abstractions\aggregate\StorableComponent
     *                           abstract class implementation that will
     *                           be used for testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the
     * DarlingCms\abstractions\aggregate\StorableComponent
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        $constructorArgs = ['ComponentName', 'ComponentLocation', 'ComponentContainer'];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\aggregate\StorableComponent', $constructorArgs);
    }

    /**
     * Assert that the getLocation() method returns a non empty string.
     */
    public function testGetLocationReturnsNonEmptyString() {
        $this->isNonEmptyString($this->component->getLocation());
    }

    /**
     * Assert that the getContainer() method returns a non empty string.
     */
    public function testGetContainerReturnsNonEmptyString() {
        $this->isNonEmptyString($this->component->getContainer());
    }


    /**
     * Assert that a string is made up of only alphanumeric characters.
     */
    private function stringIsAlphaNum(string $string) {
        $this->assertTrue(ctype_alnum($string));
    }

}
