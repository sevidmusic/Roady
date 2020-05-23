<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as StandardStorageDriver;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Factory\BaseComponentFactory;

trait BaseComponentFactoryTestTrait
{

    private $baseComponentFactory;

    public function testBuildComponentReturnsComponentImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Component',
                $this->getBaseComponentFactory()->buildComponent('AssignedName', 'AssignedContainer')
            )
        );
    }

    private function isProperImplementation(string $expectedImplementation, $class): bool
    {
        return in_array($expectedImplementation, class_implements($class));
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

    protected function setBaseComponentFactoryParentTestInstances(): void
    {
        $this->setPrimaryFactory($this->getBaseComponentFactory());
        $this->setPrimaryFactoryParentTestInstances();
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */

    private function wasStoredOnBuild(Component $component): bool // note : call after call to build*() | i.e., $comp = build(); wasStoredOnBuild($comp) // true if stored, false otherwise; | i.e for state true assertTrue(wasStoredOnBuild($comp)) | for state false assertFalse(wasStoredOnBuild($comp)
    {
        // keep this line for debugging till dev is finished $this->getMockCrud()->create($component);
        $wasStored = ($this->getMockCrud()->read($component)->getName() === $component->getName());
        $this->getMockCrud()->delete($component);
        return $wasStored;
    }

    protected function getMockCrud(): ComponentCrud
    {
        return new ComponentCrud(
            new Storable('MockCrud', 'Temp', 'Temp'),
            new Switchable(),
            new StandardStorageDriver(
                new Storable('MockStandardStorageDriver', 'Temp', 'Temp'),
                new Switchable()
            )
        );
    }

    public function testComponentCrudPropertyIsAssignedComponentCrudImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Crud\ComponentCrud',
                $this->getBaseComponentFactory()->export()['componentCrud']
            )
        );
    }

    public function testBuildComponentStoresBuiltComponent(): void
    {
        $component = $this->getBaseComponentFactory()->buildComponent('AssignedName', 'AssignedContainer');
        $this->assertTrue($this->wasStoredOnBuild($component), 'buildComponent() MUST store built Component!');
    }

    public function testBuildSwitchableComponentStoresBuiltSwitchableComponent(): void
    {
        $switchableComponent = $this->getBaseComponentFactory()->buildSwitchableComponent('AssignedName', 'AssignedContainer');
        $this->assertTrue($this->wasStoredOnBuild($switchableComponent), 'buildSwitchableComponent() MUST store built SwitchableComponent!');
    }

    public function testBuildOutputComponentStoresBuiltOutputComponent(): void
    {
        $outputComponent = $this->getBaseComponentFactory()->buildOutputComponent('AssignedName', 'AssignedContainer', 'Assigned output.', 420.87);
        $this->assertTrue($this->wasStoredOnBuild($outputComponent), 'buildOutputComponent() MUST store built OutputComponent!');
    }

    public function testBuildActionStoresBuiltAction(): void
    {
        $action = $this->getBaseComponentFactory()->buildAction('AssignedName', 'AssignedContainer', 420.87);
        $this->assertTrue($this->wasStoredOnBuild($action), 'buildAction() MUST store built Action!');
    }

    /**
     * *Tests:
     * All Must test that build*() returns instance whose settable properties reflect parameters passed to build
     * This will have to be done for each build method since constructors may vary
     * These tests can be implemented last.
     */
}
