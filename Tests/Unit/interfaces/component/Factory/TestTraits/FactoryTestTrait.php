<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use roady\interfaces\component\Factory\Factory as FactoryInterface;
use roady\interfaces\component\Web\App as AppInterface;

trait FactoryTestTrait
{

    private FactoryInterface $factory;

    public function testAppPropertyIsAssignedAppImplementationInstancePostInstantiation(): void
    {
        $classImplements = class_implements($this->getFactory()->export()['app']);
        $this->assertTrue(
            in_array(
                AppInterface::class,
                (is_array($classImplements) ? $classImplements : [])
            )
        );
    }

    public function getFactory(): FactoryInterface
    {
        return $this->factory;
    }

    public function setFactory(FactoryInterface $factory): void
    {
        $this->factory = $factory;
    }

    public function testGetAppReturnsAppAssignedToAppProperty(): void
    {
        $this->assertEquals(
            $this->getFactory()->export()['app'],
            $this->getFactory()->getApp()
        );
    }

    public function testGetAppDomainReturnsRequestReturnedByAssignedAppsGetAppDomainMethod(): void
    {
        $this->assertEquals(
            $this->getFactory()->getApp()->getAppDomain(),
            $this->getFactory()->getAppDomain()
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
}
