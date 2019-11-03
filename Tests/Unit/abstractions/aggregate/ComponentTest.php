<?php

namespace UnitTests\abstractions\aggregate;

use DarlingCms\abstractions\aggregate\Component;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionMethod;

/**
 * Class ComponentTest. Defines tests for the
 * DarlingCms\abstractions\aggregate\Component
 * abstract class.
 */
class ComponentTest extends TestCase
{
    /**
     * @var Component|MockObject PhpUnit mock object
     *                           instance that represents
     *                           the DarlingCms\abstractions\aggregate\Component
     *                           abstract class that will
     *                           be used for testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the
     * DarlingCms\abstractions\aggregate\Component
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        $constructorArgs = ['ComponentName', 'ComponentType'];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\aggregate\Component', $constructorArgs);
    }

    /**
     * Test that the getName() method returns a non
     * empty string.
     */
    public function testGetNameReturnsNonEmptyString()
    {
        $this->isNonEmptyString($this->component->getName());
    }

    /**
     * Test that the getUniqueId() method returns a non
     * empty string.
     */
    public function testGetUniqueIdReturnsNonEmptyString()
    {
        $this->isNonEmptyString($this->component->getUniqueId());
    }

    /**
     * Test that the getType() method returns a non
     * empty string.
     */
    public function testGetTypeReturnsNonEmptyString()
    {
        $this->isNonEmptyString($this->component->getType());
    }

    /**
     * Test the the getExpectedConstructorArguments()
     * method returns a non empty array.
     */
    public function testGetExpectedConstructorArgumentsReturnsNonEmptyArray() {
        $this->assertNotEmpty($this->component->getExpectedConstructorArguments());
    }

    /**
     * Test that the getExpectedConstructorArguments()
     * method returns an array whose keys match the
     * expected constructor argument names.
     */
    public function testGetExpectedConstructorArgumentsReturnsArrayWhoseKeysAreExpectedArgumentNames() {
        $reflection = new ReflectionMethod(get_class($this->component), '__construct');
        $expectedArgumentNames = array();
        foreach($reflection->getParameters() as $reflectionParameter) {
            array_push($expectedArgumentNames, $reflectionParameter->name);
        }
        $this->assertEquals(array_keys($this->component->getExpectedConstructorArguments()), $expectedArgumentNames);
    }

    /**
     * Test the the getExpectedConstrutorArguments()
     * method returns a array whose values are valid
     * default constructor arguments.
     */
    public function testGetExpectedConstructorArgumentsReturnsArrayWhoseValuesAreValidDefaultConstructorArgumentValues() {
        $reflection = new ReflectionMethod(get_class($this->component), '__construct');
        $expectedArgumentTypes = array();
        foreach($reflection->getParameters() as $reflectionParameter) {
            array_push($expectedArgumentTypes, $reflectionParameter->getType()->__toString());
        }
        var_dump(get_class($this->component),$expectedArgumentTypes);
        $argumentTypes = array();
        foreach($this->component->getExpectedConstructorArguments() as $argument) {
            array_push($argumentTypes, getType($argument));
        }
        $this->assertEquals($expectedArgumentTypes, $argumentTypes);
    }

    /**
     * Assert that a value is a non empty string.
     */
    protected function isNonEmptyString(string $value) {
        $this->assertIsString($value);
        $this->assertNotEmpty($value);
    }
}
