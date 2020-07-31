<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingDataManagementSystem\classes\component\Action;
use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\interfaces\component\Factory\StandardUITemplateFactory;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate;

trait StandardUITemplateFactoryTestTrait
{

    private $suitExpectedName = 'AssignedName';
    private $suitExpectedContainer = 'AssignedContainer';
    private $expectedPosition = 420.87;
    private $standardUITemplateFactory;

    public function testBuildStandardUITemplateReturnsAnStandardUITemplateImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate',
                $this->callBuildStandardUITemplateUsingTestArguments()
            )
        );
    }

    private function callBuildStandardUITemplateUsingTestArguments(): StandardUITemplate
    {
        return $this->getStandardUITemplateFactory()->buildStandardUITemplate(
            $this->suitExpectedName,
            $this->suitExpectedContainer,
            $this->expectedPosition,
            $this->getTestOutputComponent(),
            $this->getTestAction()
        );
    }

    protected function getStandardUITemplateFactory(): StandardUITemplateFactory
    {
        return $this->standardUITemplateFactory;
    }

    protected function setStandardUITemplateFactory(StandardUITemplateFactory $standardUITemplateFactory): void
    {
        $this->standardUITemplateFactory = $standardUITemplateFactory;
    }

    private function getTestOutputComponent(): OutputComponent
    {
        return new OutputComponent(
            new Storable(
                'OutputComponent',
                'Temp',
                'Temp'
            ),
            new Switchable(),
            new Positionable(420.20)
        );
    }

    private function getTestAction(): Action
    {
        return new Action(
            new Storable(
                'Action',
                'Temp',
                'Temp'
            ),
            new Switchable(),
            new Positionable(420.20)
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
                OutputComponent::class,
                $standardUITemplate->getTypes()
            )
        );
        $this->assertTrue(
            in_array(
                Action::class,
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
