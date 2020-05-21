<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\PrimaryFactory;

trait PrimaryFactoryTestTrait
{

    private $primaryFactory;

    protected function setPrimaryFactoryParentTestInstances(): void
    {
        $this->setFactory($this->getPrimaryFactory());
        $this->setFactoryParentTestInstances();
    }

    public function getPrimaryFactory(): PrimaryFactory
    {
        return $this->primaryFactory;
    }

    public function setPrimaryFactory(PrimaryFactory $primaryFactory)
    {
        $this->primaryFactory = $primaryFactory;
    }

}
