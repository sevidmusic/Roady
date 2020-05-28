<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as CoreStandardStorageDriver;
use DarlingCms\classes\component\Factory\PrimaryFactory as CorePrimaryFactory;
use DarlingCms\classes\component\Web\App as CoreApp;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;
use DarlingCms\classes\primary\Storable as CoreStorable;
use DarlingCms\classes\primary\Switchable as CoreSwitchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Factory\StoredComponentFactory;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Web\App;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use DarlingCms\interfaces\component\Component;
use DarlingCms\classes\utility\ReflectionUtility;

trait StoredComponentFactoryTestTrait
{

    private $storedComponentFactory;
    private $app;

    public function testPrimaryFactoryPropertyIsAssignedPrimaryFactoryImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Factory\PrimaryFactory',
                $this->getStoredComponentFactory()->export()['primaryFactory']
            )
        );
    }

    protected function isProperImplementation(string $expectedImplementation, $class): bool
    {
        return in_array($expectedImplementation, class_implements($class));
    }

    protected function setStoredComponentFactoryParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getStoredComponentFactory());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getStoredComponentFactory(): StoredComponentFactory
    {
        return $this->storedComponentFactory;
    }

    protected function setStoredComponentFactory(StoredComponentFactory $storedComponentFactory): void
    {
        $this->storedComponentFactory = $storedComponentFactory;
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

    public function testSwitchablePropertyIsAssignedComponentCrudImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Crud\ComponentCrud',
                $this->getStoredComponentFactory()->export()['switchable']
            )
        );
    }

    protected function getMockCrud(): ComponentCrud
    {
        return new CoreComponentCrud(
            new CoreStorable('MockCrud', 'Temp', 'Temp'),
            new CoreSwitchable(),
            new CoreStandardStorageDriver(
                new CoreStorable('MockStandardStorageDriver', 'Temp', 'Temp'),
                new CoreSwitchable()
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

    private function wasStoredOnBuild(Component $component): bool
    {
        $wasStored = ($this->getMockCrud()->read($component)->getName() === $component->getName());
        $this->getMockCrud()->delete($component);
        return $wasStored;
    }

    protected function getMockStoredComponentRegistry(): StoredComponentRegistry
    {
        return new CoreStoredComponentRegistry(
            new CoreStorable('t','t','t'),
            $this->getMockCrud()
        );
    }

    public function testStoredComponentRegistryPropertyIsAssignedStoredComponentRegistryImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry',
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
        $this->getStoredComponentFactory()->getStoredComponentRegistry()->import(['acceptedImplementation' => 'DarlingCms\interfaces\component\Web\App']);
        $this->assertFalse(
            $this->getStoredComponentFactory()->storeAndRegister(
                $this->getStoredComponentFactory()
            )
        );
    }

    public function testStoreAndRegisterReturnsTrueIfComponentWasStored(): void
    {
        $reflectionUtility = new ReflectionUtility();
        $class = str_replace('interfaces' , 'classes', $this->getMockStoredComponentRegistry()->getAcceptedImplementation());
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

    public function testStoreAndRegisterReturnsTrueIfComponentWasRegistered(): void
    {
        $reflectionUtility = new ReflectionUtility();
        $class = str_replace('interfaces' , 'classes', $this->getMockStoredComponentRegistry()->getAcceptedImplementation());
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
        $this->assertTrue(in_array($mockInstance, $this->getStoredComponentFactory()->export()['storedComponentRegistry']->getRegisteredComponents()));
    }

}
