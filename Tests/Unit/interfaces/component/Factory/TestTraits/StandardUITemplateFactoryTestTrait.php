<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory;

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

    public function testBuildStandardUITemplateReturnsAnStandardUITemplateImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                'DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate',
                $this->getStandardUITemplateFactory()->buildStandardUITemplate(
                    'AssignedName',
                    'AssignedContainer',
                    420.87
                    /* , @todo OutptComponent ...$types */
                )
            )
        );
    }

}
