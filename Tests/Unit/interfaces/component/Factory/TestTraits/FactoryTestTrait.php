<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\Factory;

trait FactoryTestTrait
{

    private $factory;

    public function testAppPropertyIsAssignedAppImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                'DarlingCms\interfaces\component\Web\App',
                class_implements($this->getFactory()->export()['app'])
            )
        );
    }

    public function testFactoryLocationMatchesAppLocation(): void
    {
        $this->assertEquals(
            $this->getFactory()->export()['app']->getLocation(),
            $this->getFactory()->getLocation()
        );
    }

    public function testFactoryContainerMatchesFactoryCONTAINERConstant(): void
    {
        $this->assertEquals(
            $this->getFactory()::CONTAINER,
            $this->getFactory()->getContainer()
        );
    }

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
}
