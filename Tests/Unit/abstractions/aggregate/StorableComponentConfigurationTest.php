<?php

namespace UnitTests\abstractions\aggregate;

use DarlingCms\abstractions\aggregate\StorableComponentConfiguration;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class StorableComponentConfigurationTest. Defines tests for the
 * DarlingCms\abstractions\aggregate\StorableComponentConfiguration
 * abstract class.
 * @package UnitTests\abstractions\aggregate
 * @see StorableComponentConfigurationTest::setUp()
 * @see StorableComponentConfigurationTest::testGetNameReturnsNonEmptyString()
 * @see StorableComponentConfigurationTest::testGetUniqueIdReturnsNonEmptyString()
 * @see StorableComponentConfigurationTest::testGetTypeReturnsNonEmptyString()
 * @see StorableComponentConfigurationTest::testGetLocationReturnsNonEmptyString()
 * @see StorableComponentConfigurationTest::testGetContainerReturnsNonEmptyString()
 * @see StorableComponentConfigurationTest::testGetExpectedConfigurationKeysReturnsNonEmptyArray()
 */
class StorableComponentConfigurationTest extends StorableComponentTest
{
    /**
     * @var StorableComponentConfiguration|MockObject PhpUnit mock object
     *                                                instance that
     *                                                represents the
     *                                                DarlingCms\
     *                                                abstractions\
     *                                                aggregate\
     *                                                StorableComponentConfiguration
     *                                                abstract class that
     *                                                will be used for
     *                                                testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the
     * DarlingCms\abstractions\aggregate\StorableComponentConfiguration
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        // Mock StorableComponent that will be represented by the mock StorableComponentConfiguration.
        $testStorableComponentConstructorArgs = ['TestStorableComponentName', 'TestStorableComponentType', 'TestStorableComponentLocation', 'TestStorableComponentContainer'];
        $testStorableComponent = $this->getMockForAbstractClass('\DarlingCms\abstractions\aggregate\StorableComponent', $testStorableComponentConstructorArgs);
        // Mock StorableComponentConfiguration
        $constructorArgs = ['ComponentName', 'ComponentType', 'ComponentLocation', 'ComponentContainer', $testStorableComponent];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\aggregate\StorableComponentConfiguration', $constructorArgs);
    }

    /**
     * Test that the getExpectedConfigurationKeys() method returns a non-empty array.
     */
    public function testGetExpectedConfigurationKeysReturnsNonEmptyArray()
    {
        $this->assertNotEmpty($this->component->getExpectedConfigurationKeys());
    }

    /**
     * Test that the getExpectedConfigurationKeys() method returns
     * an array that has keys defined that correspond to each of
     * the expected properties of all DarlingCms\abstractions\
     * aggregate\StorableComponent implementation instances.
     * This test will check that the getExpectedConfiurationKeys()
     * method returns an array with at least the following keys
     * defined:
     *     array('name', 'uniqueId', 'type', 'location', 'container')
     */
    public function testGetExpectedConfigurationKeysReturnsArrayOfKeysThatAtLeastReflectsAStorableComponentsProperties()
    {
        $methodResult = $this->component->getExpectedConfigurationKeys();
        $requiredKeys = array('name', 'uniqueId', 'type', 'location', 'container');
        foreach ($requiredKeys as $key) {
            $this->assertTrue(in_array($key, $methodResult));
        }
    }

    /**
     * Test that the getConfiguration() method returns a non empty array.
     */
    public function testGetConfigurationReturnsNonEmptyArray(){
        $this->assertNotEmpty($this->component->getConfiguration());
    }

    /*
     * @todo Implement the following tests:
    public function testGetConfigurationReturnsArrayWithValuesSetForExpectedKeys(){}
    public function testGetConfigurationReturnsArrayThatOnlyHasKeysThatCorrespondToTheExpectedConfigurationKeys(){}
    public function testCanSetValidConfigurationKeyValuePair(){}
    public function testCannotSetInvalidConfigurationKeyValuePair(){}
    */
}
