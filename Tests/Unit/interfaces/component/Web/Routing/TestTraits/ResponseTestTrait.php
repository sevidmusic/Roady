<?php

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use DarlingCms\interfaces\component\Web\Routing\Response;

trait ResponseTestTrait
{

    private $response;

    protected function setResponseParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getResponse());
        $this->setSwitchableComponentParentTestInstances();
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

}
