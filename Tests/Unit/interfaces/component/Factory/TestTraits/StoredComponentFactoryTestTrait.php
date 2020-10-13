<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\FileSystem\JsonStorageDriver;
use DarlingDataManagementSystem\classes\component\Factory\PrimaryFactory as CorePrimaryFactory;
use DarlingDataManagementSystem\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\classes\utility\ReflectionUtility;
use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Factory\Factory;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingDataManagementSystem\interfaces\component\Web\App;

trait StoredComponentFactoryTestTrait
{

    private $storedComponentFactory;
    private $app;

    public function testPrimaryFactoryPropertyIsAssignedPrimaryFactoryImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory',
                $this->getStoredComponentFactory()->export()['primaryFactory']
            )
        );
    }

    protected function isProperImplementation(string $expectedImplementation, $class): bool
    {
        return in_array($expectedImplementation, class_implements($class));
    }

    protected function getStoredComponentFactory(): StoredComponentFactory
    {
        return $this->storedComponentFactory;
    }

    protected function setStoredComponentFactory(StoredComponentFactory $storedComponentFactory): void
    {
        $this->storedComponentFactory = $storedComponentFactory;
    }

    public function testSwitchablePropertyIsAssignedComponentCrudImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud',
                $this->getStoredComponentFactory()->export()['switchable']
            )
        );
    }

    public function testGetComponentCrudReturnsComponentCrudInstanceAssignedToSwitchableProperty(): void
    {
        $this->assertEquals(
            $this->getStoredComponentFactory()->export()['switchable'],
            $this->getStoredComponentFactory()->getComponentCrud()
        );
    }

    public function testGetPrimaryFactoryReturnsPrimaryFactoryInstanceAssignedToPrimaryFactoryProperty(): void
    {
        $this->assertEquals(
            $this->getStoredComponentFactory()->export()['primaryFactory'],
            $this->getStoredComponentFactory()->getPrimaryFactory()
        );
    }

    public function testGetStoredComponentRegistryReturnsStoredComponentRegistryInstanceAssignedToStoredComponentRegistryProperty(): void
    {
        $this->assertEquals(
            $this->getStoredComponentFactory()->export()['storedComponentRegistry'],
            $this->getStoredComponentFactory()->getStoredComponentRegistry()
        );
    }

    public function testStoredComponentRegistryPropertyIsAssignedStoredComponentRegistryImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry',
                $this->getStoredComponentFactory()->export()['storedComponentRegistry']
            )
        );
    }

    public function testStoreAndRegisterReturnsFalseIfComponentWasNotStored(): void
    {
        $this->getStoredComponentFactory()->switchState();
        $this->assertFalse(
            $this->getStoredComponentFactory()->storeAndRegister(
                $this->getStoredComponentFactory()
            )
        );
    }

    public function testStoreAndRegisterReturnsFalseIfComponentWasNotRegistered(): void
    {
        $this->getStoredComponentFactory()->getStoredComponentRegistry()->import(['acceptedImplementation' => 'DarlingDataManagementSystem\interfaces\component\Web\App']);
        $this->assertFalse(
            $this->getStoredComponentFactory()->storeAndRegister(
                $this->getStoredComponentFactory()
            )
        );
    }

    public function testStoreAndRegisterReturnsTrueIfComponentWasStored(): void
    {
        $reflectionUtility = new ReflectionUtility();
        $class = str_replace('interfaces', 'classes', $this->getMockStoredComponentRegistry()->getAcceptedImplementation());
        $mockInstance = $reflectionUtility->getClassInstance(
            $class,
            $reflectionUtility->generateMockClassMethodArguments(
                $class,
                '__construct'
            )
        );
        $this->assertTrue(
            $this->getStoredComponentFactory()->storeAndRegister(
                $mockInstance
            )
        );
        $this->assertTrue($this->wasStoredOnBuild($mockInstance));
    }

    protected function getMockStoredComponentRegistry(): StoredComponentRegistry
    {
        return new CoreStoredComponentRegistry(
            new CoreStorable('t', 't', 't'),
            $this->getMockCrud()
        );
    }

    protected function getMockCrud(): ComponentCrud
    {
        return new CoreComponentCrud(
            new CoreStorable('MockCrud', 'Temp', 'Temp'),
            new CoreSwitchable(),
            new JsonStorageDriver(
                new CoreStorable('MockStandardStorageDriver', 'Temp', 'Temp'),
                new CoreSwitchable()
            )
        );
    }

    protected function wasStoredOnBuild(Component $component): bool
    {
        /** @var @devNote: Non-strict comparison used on purpose, instances do not need to be the same in this context, but their data MUST be the same. */
        $wasStored = ($this->getMockCrud()->read($component) == $component);
        $this->getMockCrud()->delete($component);
        return $wasStored;
    }

    public function testStoreAndRegisterReturnsTrueIfComponentWasRegistered(): void
    {
        $reflectionUtility = new ReflectionUtility();
        $class = str_replace('interfaces', 'classes', $this->getMockStoredComponentRegistry()->getAcceptedImplementation());
        $mockInstance = $reflectionUtility->getClassInstance(
            $class,
            $reflectionUtility->generateMockClassMethodArguments(
                $class,
                '__construct'
            )
        );
        $this->assertTrue(
            $this->getStoredComponentFactory()->storeAndRegister(
                $mockInstance
            )
        );
        $this->assertTrue($this->wasRegisteredOnBuild($mockInstance));
    }

    protected function wasRegisteredOnBuild(Component $component): bool
    {
        return in_array($component, $this->getStoredComponentFactory()->export()['storedComponentRegistry']->getRegisteredComponents());
    }

    protected function getFactory(): Factory
    {
        return $this->storedComponentFactory;
    }

    protected function setStoredComponentFactoryParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getStoredComponentFactory());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getMockPrimaryFactory(): PrimaryFactory
    {
        return new CorePrimaryFactory($this->getMockApp());
    }

    protected function getMockApp(): App
    {
        if (empty($this->app) === true) {
            $currentRequest = new CoreRequest(
                new CoreStorable(
                    'CurrentRequest',
                    'Requests',
                    'Index'
                ),
                new CoreSwitchable()
            );
            $this->app = new CoreApp($currentRequest, new CoreSwitchable());
        }
        return $this->app;
    }

}
