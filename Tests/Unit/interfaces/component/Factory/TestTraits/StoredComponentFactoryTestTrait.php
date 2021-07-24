<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use roady\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use roady\classes\component\Driver\Storage\FileSystem\JsonStorageDriver as CoreJsonStorageDriver;
use roady\classes\component\Factory\PrimaryFactory as CorePrimaryFactory;
use roady\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use roady\classes\component\Web\App as CoreApp;
use roady\classes\component\Web\Routing\Request as CoreRequest;
use roady\classes\primary\Storable as CoreStorable;
use roady\classes\primary\Switchable as CoreSwitchable;
use roady\classes\utility\ReflectionUtility as CoreReflectionUtility;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Factory\Factory as FactoryInterface;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use roady\interfaces\component\Web\App as AppInterface;

trait StoredComponentFactoryTestTrait
{

    private StoredComponentFactoryInterface $storedComponentFactory;
    private AppInterface $app;

    public function testGetNameReturnsNameThatMatchesAssignedAppsName(): void
    {
        $this->assertEquals(
            $this->getStoredComponentFactory()->export()['app']->getName(),
            $this->getStoredComponentFactory()->getName()
        );

    }

    public function testPrimaryFactoryPropertyIsAssignedPrimaryFactoryImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                PrimaryFactoryInterface::class,
                $this->getStoredComponentFactory()->export()['primaryFactory']
            )
        );
    }

    protected function getStoredComponentFactory(): StoredComponentFactoryInterface
    {
        return $this->storedComponentFactory;
    }

    protected function setStoredComponentFactory(StoredComponentFactoryInterface $storedComponentFactory): void
    {
        $this->storedComponentFactory = $storedComponentFactory;
    }

    public function testSwitchablePropertyIsAssignedComponentCrudImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                ComponentCrudInterface::class,
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
                StoredComponentRegistryInterface::class,
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
        $this->getStoredComponentFactory()->getStoredComponentRegistry()->import(
            [
                'acceptedImplementation' => AppInterface::class
            ]
        );
        $this->assertFalse(
            $this->getStoredComponentFactory()->storeAndRegister(
                $this->getStoredComponentFactory()
            )
        );
    }

    public function testStoreAndRegisterReturnsTrueIfComponentWasStored(): void
    {
        $reflectionUtility = new CoreReflectionUtility();
        /**
         * @var class-string<object>|object $class
         */
        $class = str_replace('interfaces', 'classes', $this->getMockStoredComponentRegistry()->getAcceptedImplementation());
        /**
         *
         * @var ComponentInterface $mockInstance
         */
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

    protected function getMockStoredComponentRegistry(): StoredComponentRegistryInterface
    {
        return new CoreStoredComponentRegistry(
            new CoreStorable('t', 't', 't'),
            $this->getMockCrud()
        );
    }

    protected function getMockCrud(): ComponentCrudInterface
    {
        return new CoreComponentCrud(
            new CoreStorable('MockCrud', 'Temp', 'Temp'),
            new CoreSwitchable(),
            new CoreJsonStorageDriver(
                new CoreStorable('MockStandardStorageDriver', 'Temp', 'Temp'),
                new CoreSwitchable()
            )
        );
    }

    protected function wasStoredOnBuild(ComponentInterface $component): bool
    {
        /** @devNote: Non-strict comparison used on purpose, instances do not need to be the same in this context, but their data MUST be the same. */
        /** @noinspection PhpNonStrictObjectEqualityInspection */
        $wasStored = ($this->getMockCrud()->read($component) == $component);
        $this->getMockCrud()->delete($component);
        return $wasStored;
    }

    public function testStoreAndRegisterReturnsTrueIfComponentWasRegistered(): void
    {
        $reflectionUtility = new CoreReflectionUtility();
        /**
         * @var class-string<object>|object $class
         */
        $class = str_replace('interfaces', 'classes', $this->getMockStoredComponentRegistry()->getAcceptedImplementation());
        /**
         * @var ComponentInterface $mockInstance
         */
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

    protected function wasRegisteredOnBuild(ComponentInterface $component): bool
    {
        return in_array($component, $this->getStoredComponentFactory()->export()['storedComponentRegistry']->getRegisteredComponents());
    }

    protected function getFactory(): FactoryInterface
    {
        return $this->storedComponentFactory;
    }

    protected function setStoredComponentFactoryParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getStoredComponentFactory());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getMockPrimaryFactory(): PrimaryFactoryInterface
    {
        return new CorePrimaryFactory($this->getMockApp());
    }

    protected function getMockApp(): AppInterface
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
