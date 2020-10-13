<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingDataManagementSystem\classes\component\Action as CoreAction;
use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Factory\StandardUITemplateFactory as StandardUITemplateFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;

trait StandardUITemplateFactoryTestTrait
{

    private string $suitExpectedName = 'AssignedName';
    private string $suitExpectedContainer = 'AssignedContainer';
    private float $expectedPosition = 420.87;
    private StandardUITemplateFactoryInterface $standardUITemplateFactory;

    public function testBuildStandardUITemplateReturnsAnStandardUITemplateImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                StandardUITemplateInterface::class,
                $this->callBuildStandardUITemplateUsingTestArguments()
            )
        );
    }

    private function callBuildStandardUITemplateUsingTestArguments(): StandardUITemplateInterface
    {
        return $this->getStandardUITemplateFactory()->buildStandardUITemplate(
            $this->suitExpectedName,
            $this->suitExpectedContainer,
            $this->expectedPosition,
            $this->getTestOutputComponent(),
            $this->getTestAction()
        );
    }

    protected function getStandardUITemplateFactory(): StandardUITemplateFactoryInterface
    {
        return $this->standardUITemplateFactory;
    }

    protected function setStandardUITemplateFactory(StandardUITemplateFactoryInterface $standardUITemplateFactory): void
    {
        $this->standardUITemplateFactory = $standardUITemplateFactory;
    }

    private function getTestOutputComponent(): CoreOutputComponent
    {
        return new CoreOutputComponent(
            new CoreStorable(
                'OutputComponent',
                'Temp',
                'Temp'
            ),
            new CoreSwitchable(),
            new CorePositionable(420.20)
        );
    }

    private function getTestAction(): CoreAction
    {
        return new CoreAction(
            new CoreStorable(
                'Action',
                'Temp',
                'Temp'
            ),
            new CoreSwitchable(),
            new CorePositionable(420.20)
        );
    }

    public function testBuildStandardUITemplateStoresTheStandardUITemplateImplementationInstanceItBuilds(): void
    {
        $standardUITemplate = $this->callBuildStandardUITemplateUsingTestArguments();
        $this->assertTrue($this->wasStoredOnBuild($standardUITemplate));
    }

    public function testBuildStandardUITemplateRegistersTheStandardUITemplateImplementationInstanceItBuilds(): void
    {
        $standardUITemplate = $this->callBuildStandardUITemplateUsingTestArguments();
        $this->assertTrue(
            $this->wasRegisteredOnBuild($standardUITemplate),
            sprintf(
                'StandardUITemplate %s was not registered.',
                $standardUITemplate->getUniqueId()
            )
        );
    }

    public function testBuildStandardUITemplateReturnsStandardUITemplateWhoseNameMatchesSuppliedName(): void
    {
        $standardUITemplate = $this->callBuildStandardUITemplateUsingTestArguments();
        $this->assertEquals(
            $this->suitExpectedName,
            $standardUITemplate->getName(),
        );
    }

    public function testBuildStandardUITemplateReturnsStandardUITemplateWhoseContainerMatchesSuppliedContainer(): void
    {
        $standardUITemplate = $this->callBuildStandardUITemplateUsingTestArguments();
        $this->assertEquals(
            $this->suitExpectedContainer,
            $standardUITemplate->getContainer(),
        );
    }

    public function testBuildStandardUITemplateReturnsStandardUITemplateWhosePositionMatchesSuppliedPosition(): void
    {
        $standardUITemplate = $this->callBuildStandardUITemplateUsingTestArguments();
        $this->assertEquals(
            $this->expectedPosition,
            $standardUITemplate->getPosition(),
        );
    }

    public function testBuildStandardUITemplateReturnsStandardUITemplateWhoseAssignedTypesReflectSuppliedTypes(): void
    {
        $standardUITemplate = $this->callBuildStandardUITemplateUsingTestArguments();
        $this->assertTrue(
            in_array(
                CoreOutputComponent::class,
                $standardUITemplate->getTypes()
            )
        );
        $this->assertTrue(
            in_array(
                CoreAction::class,
                $standardUITemplate->getTypes()
            )
        );

    }

    protected function setStandardUITemplateFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getStandardUITemplateFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }
}
