<?php

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use DarlingCms\interfaces\component\Web\Routing\Request;

trait RequestTestTrait
{

    private $request;

    protected function setRequestParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getRequest());
        $this->setSwitchableComponentParentTestInstances();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

}
