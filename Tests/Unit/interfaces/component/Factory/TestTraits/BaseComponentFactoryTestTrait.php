<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\BaseComponentFactory;

trait BaseComponentFactoryTestTrait
{

    private $baseComponentFactory;

    protected function setBaseComponentFactoryParentTestInstances(): void
    {
        $this->setPrimaryFactory($this->getBaseComponentFactory());
        $this->setPrimaryFactoryParentTestInstances();
    }

    public function getBaseComponentFactory(): BaseComponentFactory
    {
        return $this->baseComponentFactory;
    }

    public function setBaseComponentFactory(BaseComponentFactory $baseComponentFactory)
    {
        $this->baseComponentFactory = $baseComponentFactory;
    }

}
