<?php

namespace UnitTests\abstractions\aggregate;

use DarlingCms\abstractions\aggregate\Component;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionMethod;

/**
 * Class ComponentTest. Defines tests for the
 * DarlingCms\abstractions\aggregate\Component abstract class.
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
     * Assert that an array's values are valid default constructor arguments.
     */
     public function valuesAreValidDefualtExpectedConstructorArgumentTypes(array$array) {
        $argumentTypes = array();
        foreach($array as $argument) {
            array_push($argumentTypes, getType($argument));
        }
        var_dump(['Expected'=> $this->getComponentConstructorParamerterInfo('t'), 'Actual' => $argumentTypes]);
        $this->assertEquals($this->getComponentConstructorParamerterInfo('t'), $argumentTypes);
    }

    /**
     * Assert that a value is a non empty string.
     */
    protected function isNonEmptyString(string $value) {
        $this->assertIsString($value);
        $this->assertNotEmpty($value);
    }

    /**
     * Assert that a value us a non empty array.
     */
    protected function isNonEmptyArray(array $array) {
        $this->assertIsArray($array);
        $this->assertNotEmpty($array);
    }

    /**
     * Assert that an array's element count matchese the number of
     * expected constructor arguments.
     */
    protected function elementCountMatchesNumberOfExpectedConstructorArguments(array $array) {
        $this->assertEquals(count($array), count($this->getComponentConstructorParamerterInfo('n')));
    }

    /**
     * Assert that an array's elements are ordered
     * according to the order of the expected constructor
     * arguments.
     */
    protected function elementsOrderedAccordingToExpectedConstructorArgumentOrder() {
        // @todo implement this method
    }


    /**
     * Assert that the keys of an array match the expected constructor argument
     * names.
     */
    protected function keysMatchExpectedConstructorArgumentNames(array $array) {
        $this->assertEquals(array_keys($array), $this->getComponentConstructorParamerterInfo('name'));
    }

    /**
     * Request information about the Component's constructor parameters.
     * @var string $request A single character that determines what info
     *                      is returned:
     *                      n = Return array of the names of the constructor
     *                          paramters.
     *                      t = Return array of strings indicating the
     *                          constructor's parameter types.
     */
    protected function getComponentConstructorParamerterInfo(string $request): array {
        $reflection = new ReflectionMethod(get_class($this->component), '__construct');
        $parameterInfo = array();
        foreach($reflection->getParameters() as $reflectionParameter) {
            if($request[0] === 't') {
                array_push($parameterInfo, $reflectionParameter->getType()->__toString());
                continue;
            }
            array_push($parameterInfo, $reflectionParameter->name);
        }
        return $parameterInfo;
    }

    /**
     * Delete this test
     */
    public function testDummy() {
        $this->keysMatchExpectedConstructorArgumentNames($this->component->getExpectedConstructorArguments());
//        $this->valuesAreValidDefualtExpectedConstructorArgumentTypes($this->component->getExpectedConstructorArguments())
        $this->elementCountMatchesNumberOfExpectedConstructorArguments($this->component->getExpectedConstructorArguments());
    }
}
