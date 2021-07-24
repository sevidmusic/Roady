<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use roady\classes\component\Registry\Storage\StoredComponentRegistry as CoreStoredComponentRegistry;
use roady\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use roady\classes\component\DynamicOutputComponent as CoreDynamicOutputComponent;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use UnitTests\interfaces\component\TestTraits\DynamicOutputComponentTestTrait;

trait OutputComponentFactoryTestTrait
{

    private OutputComponentFactoryInterface $outputComponentFactory;

    abstract protected function getMockPrimaryFactory(): PrimaryFactoryInterface;

    abstract protected function getMockCrud(): ComponentCrudInterface;

    public static function setUpBeforeClass(): void
    {
        DynamicOutputComponentTestTrait::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        DynamicOutputComponentTestTrait::tearDownAfterClass();
    }

    /**
     * @return array{0: PrimaryFactoryInterface, 1: ComponentCrudInterface, 2: StoredComponentRegistryInterface}
     */
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
                    420.87,
            DynamicOutputComponentTestTrait::tempAppDirectoryName(),
                    'Duplicate.php'
                )
            )
        );

    }

    public function testBuildDynamicOutputComponentStoresTheDynamicOutputComponentImplementationInstanceItBuilds(): void
    {
        $dynamicOutputComponent = $this->getOutputComponentFactory()->buildDynamicOutputComponent(
            'AssignedName',
            'AssignedContainer',
            420.87,
            DynamicOutputComponentTestTrait::tempAppDirectoryName(),
            'Duplicate.php'
        );
        $this->assertTrue($this->wasStoredOnBuild($dynamicOutputComponent));
    }

    public function testBuildDynamicOutputComponentRegistersTheDynamicOutputComponentImplementationInstanceItBuilds(): void
    {
        $dynamicOutputComponent = $this->getOutputComponentFactory()->buildDynamicOutputComponent(
            'AssignedName',
            'AssignedContainer',
            420.87,
            DynamicOutputComponentTestTrait::tempAppDirectoryName(),
            'Duplicate.php'
        );
        $this->assertTrue($this->wasRegisteredOnBuild($dynamicOutputComponent));
    }

    public function testBuildDynamicOutputComonentReturnsADynamicOutputComponentWhoseOutputMatchesOutputOfADynamicOutputComponentInstantiatedWithSameAppDirectoryAndDynamicFileName(): void
    {
        $doc = new CoreDynamicOutputComponent(
            $this->getMockPrimaryFactory()->buildStorable(
                'Name',
                'Container'
            ),
            $this->getMockPrimaryFactory()->buildSwitchable(),
            $this->getMockPrimaryFactory()->buildPositionable(420.87),
            DynamicOutputComponentTestTrait::tempAppDirectoryName(),
            'Duplicate.php'
        );
        $fdoc = $this->getOutputComponentFactory()->buildDynamicOutputComponent(
            'AssignedName',
            'AssignedContainer',
            420.87,
            DynamicOutputComponentTestTrait::tempAppDirectoryName(),
            'Duplicate.php'
        );
        $this->assertEquals(
            $doc->getOutput(),
            $fdoc->getOutput()
        );
    }

    public function testBuildDynamicOutputComponentReturnsDynamicOutputComponentWhoseNameMatchesSuppliedName(): void
    {
        $expectedName = 'ExpectedName';
        $dynamicOutputComponent = $this->getOutputComponentFactory()->buildDynamicOutputComponent(
            $expectedName,
            'AssignedContainer',
            420.87,
            DynamicOutputComponentTestTrait::tempAppDirectoryName(),
            'Duplicate.php'
        );
        $this->assertEquals(
            $expectedName,
            $dynamicOutputComponent->getName(),
        );
    }

    public function testBuildDynamicOutputComponentReturnsDynamicOutputComponentWhoseContainerMatchesSuppliedContainer(): void
    {
        $expectedContainer = 'ExpectedContainer';
        $dynamicOutputComponent = $this->getOutputComponentFactory()->buildDynamicOutputComponent(
            'AssignedName',
            $expectedContainer,
            420.87,
            DynamicOutputComponentTestTrait::tempAppDirectoryName(),
            'Duplicate.php'
        );
        $this->assertEquals(
            $expectedContainer,
            $dynamicOutputComponent->getContainer(),
        );
    }

    public function testBuildDynamicOutputComponentReturnsDynamicOutputComponentWhosePositionMatchesSuppliedPosition(): void
    {
        $expectedPosition = 420.87;
        $dynamicOutputComponent = $this->getOutputComponentFactory()->buildDynamicOutputComponent(
            'AssignedName',
            'AssignedContainer',
            $expectedPosition,
            DynamicOutputComponentTestTrait::tempAppDirectoryName(),
            'Duplicate.php'
        );
        $this->assertEquals(
            $expectedPosition,
            $dynamicOutputComponent->getPosition(),
        );
    }

}
