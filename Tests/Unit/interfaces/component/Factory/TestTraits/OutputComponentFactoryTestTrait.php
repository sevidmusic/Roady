<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingDataManagementSystem\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use DarlingDataManagementSystem\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;

trait OutputComponentFactoryTestTrait
{

    private OutputComponentFactoryInterface $outputComponentFactory;

    protected function getOutputComponentFactoryTestArgs(): array
    {
        return array(
            $this->getMockPrimaryFactory(),
            $this->getMockCrud(),
            $this->getMockStoredComponentRegistry()
        );
    }

    public function testBuildOutputComponentReturnsAnOutputComponentImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                OutputComponentInterface::class,
                $this->getOutputComponentFactory()->buildOutputComponent(
                    'AssignedName',
                    'AssignedContainer',
                    'Assigned Output', 420.87
                )
            )
        );
    }

    protected function getOutputComponentFactory(): OutputComponentFactoryInterface
    {
        return $this->outputComponentFactory;
    }

    protected function setOutputComponentFactory(OutputComponentFactoryInterface $outputComponentFactory): void
    {
        $this->outputComponentFactory = $outputComponentFactory;
    }

    public function testBuildOutputComponentStoresTheOutputComponentImplementationInstanceItBuilds(): void
    {
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent(
            'AssignedName',
            'AssignedContainer',
            'Assigned Output',
            420.87
        );
        $this->assertTrue($this->wasStoredOnBuild($outputComponent));
    }

    public function testBuildOutputComponentRegistersTheOutputComponentImplementationInstanceItBuilds(): void
    {
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent(
            'AssignedName',
            'AssignedContainer',
            'Assigned Output',
            420.87
        );
        $this->assertTrue($this->wasRegisteredOnBuild($outputComponent));
    }

    public function testBuildOutputComponentReturnsOutputComponentWhoseNameMatchesSuppliedName(): void
    {
        $expectedName = 'ExpectedName';
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent(
            $expectedName,
            'AssignedContainer',
            'Assigned Output',
            420.87
        );
        $this->assertEquals(
            $expectedName,
            $outputComponent->getName(),
        );
    }

    public function testBuildOutputComponentReturnsOutputComponentWhoseContainerMatchesSuppliedContainer(): void
    {
        $expectedContainer = 'ExpectedContainer';
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent(
            'AssignedName',
            $expectedContainer,
            'Assigned Output',
            420.87
        );
        $this->assertEquals(
            $expectedContainer,
            $outputComponent->getContainer(),
        );
    }

    public function testBuildOutputComponentReturnsOutputComponentWhoseOutputMatchesSuppliedOutput(): void
    {
        $expectedOutput = 'Expected output';
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent(
            'AssignedName',
            'AssignedContainer',
            $expectedOutput,
            420.87
        );
        $this->assertEquals(
            $expectedOutput,
            $outputComponent->getOutput(),
        );
    }

    public function testBuildOutputComponentReturnsOutputComponentWhosePositionMatchesSuppliedPosition(): void
    {
        $expectedPosition = 420.87;
        $outputComponent = $this->getOutputComponentFactory()->buildOutputComponent(
            'AssignedName',
            'AssignedContainer',
            'Assigned output',
            $expectedPosition
        );
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

    protected function getMockStoredComponentRegistry(): StoredComponentRegistryInterface
    {
        $mockStoredComponentRegistry = new CoreStoredComponentRegistry(
            $this->getMockPrimaryFactory()->buildStorable('t', 't'),
            $this->getMockCrud()
        );
        $mockStoredComponentRegistry->import(
            [
                'acceptedImplementation' => OutputComponentInterface::class
            ]
        );
        return $mockStoredComponentRegistry;
    }

    public function testBuildDynamicOutputComponentReturnsADynamicOutputComponentImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                DynamicOutputComponentInterface::class,
                $this->getOutputComponentFactory()->buildDynamicOutputComponent(
                    'AssignedName',
                    'AssignedContainer',
                    'Assigned Output',
                    420.87,
                    'helloWorld',
                    'Duplicate.php'
                )
            )
        );

    }

    public function testBuildDynamicOutputComponentStoresTheDynamicOutputComponentImplementationInstanceItBuilds(): void
    {
        $outputComponent = $this->getOutputComponentFactory()->buildDynamicOutputComponent(
            'AssignedName',
            'AssignedContainer',
            'Assigned Output',
            420.87,
            'helloWorld',
            'Duplicate.php'
        );
        $this->assertTrue($this->wasStoredOnBuild($outputComponent));
    }

}
