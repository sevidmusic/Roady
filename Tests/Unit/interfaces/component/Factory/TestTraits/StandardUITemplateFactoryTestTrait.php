<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Action;

trait StandardUITemplateFactoryTestTrait
{

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

    public function testBuildStandardUITemplateReturnsAnStandardUITemplateImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate',
                $this->getStandardUITemplateFactory()->buildStandardUITemplate(
                    'AssignedName',
                    'AssignedContainer',
                    420.87,
                    $this->getTestOutputComponent(),
                    $this->getTestAction()
                )
            )
        );
    }

}
