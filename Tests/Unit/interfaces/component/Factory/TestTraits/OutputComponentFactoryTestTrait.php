<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use DarlingCms\interfaces\component\Factory\OutputComponentFactory;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;

trait OutputComponentFactoryTestTrait
{

    private $outputComponentFactory;

    public function testBuildOutputComponentReturnsAnOutputComponentImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\OutputComponent',
                $this->getOutputComponentFactory()->buildOutputComponent(
                    'AssignedName',
                    'AssignedContainer',
                    'Assigned Output', 420.87
                )
            )
        );
    }

    public function testBuildOutputComponentStoresTheOutputComponentImplementationInstanceItBuilds(): void
    {
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent('AssignedName', 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertTrue($this->wasStoredOnBuild($outputComponent));
    }

    public function testBuildOutputComponentRegistersTheOutputComponentImplementationInstanceItBuilds(): void
    {
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent('AssignedName', 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertTrue($this->wasRegisteredOnBuild($outputComponent));
    }

    public function testBuildOutputComponentReturnsOutputComponentWhoseNameMatchesSuppliedName(): void
    {
        $expectedName = 'ExpectedName';
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent($expectedName, 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertEquals(
            $expectedName,
            $outputComponent->getName(),
        );
    }

    public function testBuildOutputComponentReturnsOutputComponentWhoseContainerMatchesSuppliedContainer(): void
    {
        $expectedContainer = 'ExpectedContainer';
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent('AssignedName', $expectedContainer, 'Assigned Output', 420.87);
        $this->assertEquals(
            $expectedContainer,
            $outputComponent->getContainer(),
        );
    }

    public function testBuildOutputComponentReturnsOutputComponentWhoseOutputMatchesSuppliedOutput(): void
    {
        $expectedOutput = 'Expected output';
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent('AssignedName', 'AssignedContainer', $expectedOutput, 420.87);
        $this->assertEquals(
            $expectedOutput,
            $outputComponent->getOutput(),
        );
    }

    public function testBuildOutputComponentReturnsOutputComponentWhosePositionMatchesSuppliedPosition(): void
    {
        $expectedPosition = 420.87;
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent('AssignedName', 'AssignedContainer', 'Assigned output', $expectedPosition);
        $this->assertEquals(
            $expectedPosition,
            $outputComponent->getPosition(),
        );
    }

    protected function setOutputComponentFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getOutputComponentFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    protected function getOutputComponentFactory(): OutputComponentFactory
    {
        return $this->outputComponentFactory;
    }

    protected function setOutputComponentFactory(OutputComponentFactory $outputComponentFactory): void
    {
        $this->outputComponentFactory = $outputComponentFactory;
    }

    protected function getMockStoredComponentRegistry(): StoredComponentRegistry
    {
        $mockStoredComponentRegistry = new CoreStoredComponentRegistry(
            $this->getMockPrimaryFactory()->buildStorable('t', 't'),
            $this->getMockCrud()
        );
        $mockStoredComponentRegistry->import(['acceptedImplementation' => 'DarlingCms\interfaces\component\OutputComponent']);
        return $mockStoredComponentRegistry;
    }

}
