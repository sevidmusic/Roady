<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\RequestFactory;

trait RequestFactoryTestTrait
{

    private $requestFactory;

    protected function setRequestFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getRequestFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    protected function getRequestFactory(): RequestFactory
    {
        return $this->requestFactory;
    }

    protected function setRequestFactory(RequestFactory $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

}