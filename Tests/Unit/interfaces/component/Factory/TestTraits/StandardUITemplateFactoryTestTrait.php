<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Action;

trait StandardUITemplateFactoryTestTrait
{

    private $expectedName = 'AssignedName';
    private $expectedContainer = 'AssingedContainer';
    private $standardUITemplateFactory;

    protected function setStandardUITemplateFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getStandardUITemplateFactory());
        $this->setStoredComponentFactoryParentTestInstances();
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

    private function callBuildStandardUITemplateUsingTestArguments(): StandardUITemplate {
        return $this->getStandardUITemplateFactory()->buildStandardUITemplate(
            $this->expectedName,
            $this->expectedContainer,
            420.87,
            $this->getTestOutputComponent(),
            $this->getTestAction()
        );
    }

    public function testBuildStandardUITemplateReturnsAnStandardUITemplateImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate',
                $this->callBuildStandardUITemplateUsingTestArguments()
            )
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
        $this->assertTrue($this->wasRegisteredOnBuild($standardUITemplate));
    }

    public function testBuildStandardUITemplateReturnsStandardUITemplateWhoseNameMatchesSuppliedName(): void
    {
        $standardUITemplate = $this->callBuildStandardUITemplateUsingTestArguments();
        $this->assertEquals(
            $this->expectedName,
            $standardUITemplate->getName(),
        );
    }

    public function testBuildStandardUITemplateReturnsStandardUITemplateWhoseContainerMatchesSuppliedContainer(): void
    {
        $standardUITemplate = $this->callBuildStandardUITemplateUsingTestArguments();
        $this->assertEquals(
            $this->expectedContainer,
            $standardUITemplate->getContainer(),
        );
    }

}
