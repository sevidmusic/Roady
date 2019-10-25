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
 * @see StorableComponentConfigurationTest::
 * @see StorableComponentConfigurationTest::
 * @see StorableComponentConfigurationTest::
 * @see StorableComponentConfigurationTest::
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
}
