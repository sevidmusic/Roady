<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\Factory;

trait FactoryTestTrait
{

    private $factory;

    protected function setFactoryParentTestInstances(): void
    {
        $this->setComponent($this->getFactory());
        $this->setComponentParentTestInstances();
    }

    public function getFactory(): Factory
    {
        return $this->factory;
    }

    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function testAppPropertyIsAssignedAppImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingCms\interfaces\component\Web\App',
                class_implements($this->getFactory()->export()['app'])
            )
        );
    }

}
