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

    private function wasStoredOnBuild(Component $component): bool
    {
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

    public function testBuildComponentReturnsComponentWhoseNameAndContainerMatchSpecifiedNameAndContainerAndWhoseLocationMatchesAppLocation(): void
    {
        $expectedName = 'AssignedName';
        $expectedContainer = 'AssignedContainer';
        $expectedLocation = $this->getBaseComponentFactory()->export()['app']->getLocation();
        $component = $this->getBaseComponentFactory()->buildComponent($expectedName, $expectedContainer);
        $this->assertEquals($expectedName, $component->getName());
        $this->assertEquals($expectedContainer, $component->getContainer());
        $this->assertEquals($expectedLocation, $component->getLocation());
    }

    public function testBuildSwitchableComponentReturnsSwitchableComponentWhoseNameAndContainerMatchSpecifiedNameAndContainerAndWhoseLocationMatchesAppLocation(): void
    {
        $expectedName = 'AssignedName';
        $expectedContainer = 'AssignedContainer';
        $expectedLocation = $this->getBaseComponentFactory()->export()['app']->getLocation();
        $switchableComponent = $this->getBaseComponentFactory()->buildSwitchableComponent($expectedName, $expectedContainer);
        $this->assertEquals($expectedName, $switchableComponent->getName());
        $this->assertEquals($expectedContainer, $switchableComponent->getContainer());
        $this->assertEquals($expectedLocation, $switchableComponent->getLocation());
    }

    public function testBuildOutputComponentReturnsOutputComponentWhoseNameAndContainerMatchSpecifiedNameAndContainerAndWhoseLocationMatchesAppLocationAndWhoseOutputMatchesSpecifiedOutputAndWhosePositionMatchesSpecifiedPosition(): void
    {
        $expectedName = 'AssignedName';
        $expectedContainer = 'AssignedContainer';
        $expectedLocation = $this->getBaseComponentFactory()->export()['app']->getLocation();
        $expectedOutput = 'Assigned output.';
        $expectedPosition = 420.87;
        $outputComponent = $this->getBaseComponentFactory()->buildOutputComponent($expectedName, $expectedContainer, $expectedOutput, $expectedPosition);
        $this->assertEquals($expectedName, $outputComponent->getName());
        $this->assertEquals($expectedContainer, $outputComponent->getContainer());
        $this->assertEquals($expectedLocation, $outputComponent->getLocation());
        $this->assertEquals($expectedOutput, $outputComponent->getOutput());
        $this->assertEquals($expectedPosition, $outputComponent->getPosition());
    }

    public function testBuildActionReturnsActionWhoseNameAndContainerMatchSpecifiedNameAndContainerAndWhoseLocationMatchesAppLocationAndWhosePositionMatchesSpecifiedPosition(): void
    {
        $expectedName = 'AssignedName';
        $expectedContainer = 'AssignedContainer';
        $expectedLocation = $this->getBaseComponentFactory()->export()['app']->getLocation();
        $expectedPosition = 420.87;
        $action = $this->getBaseComponentFactory()->buildAction($expectedName, $expectedContainer, $expectedPosition);
        $this->assertEquals($expectedName, $action->getName());
        $this->assertEquals($expectedContainer, $action->getContainer());
        $this->assertEquals($expectedLocation, $action->getLocation());
        $this->assertEquals($expectedPosition, $action->getPosition());
    }

}
