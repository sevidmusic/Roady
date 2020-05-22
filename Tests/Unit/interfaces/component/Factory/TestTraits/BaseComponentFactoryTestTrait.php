<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\BaseComponentFactory;
use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as StandardStorageDriver;
use DarlingCms\interfaces\component\Component;

trait BaseComponentFactoryTestTrait
{

    private $baseComponentFactory;

    private function  getMockCrud(): ComponentCrud
    {
        return new ComponentCrud(
            $this->getBaseComponentFactory()->buildStorable('MockCrud', 'TEMP'),
            $this->getBaseComponentFactory()->buildSwitchable(),
            new StandardStorageDriver(
                $this->getBaseComponentFactory()->buildStorable('MockStandardStorageDriver','TEMP'),
                $this->getBaseComponentFactory()->buildSwitchable()
            )
        );
    }

    protected function setBaseComponentFactoryParentTestInstances(): void
    {
        $this->setPrimaryFactory($this->getBaseComponentFactory());
        $this->setPrimaryFactoryParentTestInstances();
    }

    public function getBaseComponentFactory(): BaseComponentFactory
    {
        return $this->baseComponentFactory;
    }

    public function setBaseComponentFactory(BaseComponentFactory $baseComponentFactory)
    {
        $this->baseComponentFactory = $baseComponentFactory;
        //$this->assertTrue($this->isProperImplementation('DarlingCms\interfaces\component\Factory\PrimaryFactory', $this->baseComponentFactory));
        //var_dump($this->getMockCrud());
        //var_dump($this->wasStoredOnBuild($this->getBaseComponentFactory()));
    }

    private function isProperImplementation(string $expectedImplementation, $class): bool
    {
        return in_array($expectedImplementation, class_implements($class));
    }

    private function wasStoredOnBuild(Component $component): bool // note : call after call to build*() | i.e., $comp = build(); wasStoredOnBuild($comp) // true if stored, false otherwise; | i.e for state true assertTrue(wasStoredOnBuild($comp)) | for state false assertFalse(wasStoredOnBuild($comp)
    {
        // keep this line for debugging till dev is finished $this->getMockCrud()->create($component);
        $wasStored = ($this->getMockCrud()->read($component)->getName() === $component->getName());
        $this->getMockCrud()->delete($component);
        return $wasStored;
    }

    public function testBuildComponentReturnsComponentImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Component',
                $this->getBaseComponentFactory()->buildComponent('AssignedName', 'AssignedContainer')
            )
        );
    }

    public function testBuildSwitchableComponentReturnsSwitchableComponentImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\SwitchableComponent',
                $this->getBaseComponentFactory()->buildSwitchableComponent('AssignedName', 'AssignedContainer')
            )
        );
    }

    public function testBuildOutputComponentReturnsOutputComponentImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\OutputComponent',
                $this->getBaseComponentFactory()->buildOutputComponent('AssignedName', 'AssignedContainer', 'Assigned output.', 420.87)
            )
        );
    }

    public function testBuildActionReturnsActionImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Action',
                $this->getBaseComponentFactory()->buildAction('AssignedName', 'AssignedContainer', 420.87)
            )
        );
    }

    /**
     * *Tests:
     * All Must test that build*() returns instance whose settable properties reflect parameters passed to build
     * This will have to be done for each build method since constructors may vary
     * These tests can be implemented last.
     */
}
