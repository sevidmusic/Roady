<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\ResponseFactory;

trait ResponseFactoryTestTrait
{

    private $responseFactory;

    protected function setResponseFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getResponseFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    protected function getResponseFactory(): ResponseFactory
    {
        return $this->responseFactory;
    }

    protected function setResponseFactory(ResponseFactory $responseFactory): void
    {
        $this->responseFactory = $responseFactory;
    }

}