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

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function testGetGetReturnsGetArray(): void
    {
        $this->getArrayTestUtility()->arraysAreEqual($_GET, $this->getRequest()->getGet());
    }

    public function testGetPostReturnsPostArray(): void
    {
        $this->getArrayTestUtility()->arraysAreEqual($_POST, $this->getRequest()->getPost());
    }

    public function testCanGetUrl(): void
    {
        $this->getStringTestUtility()->stringIsNotEmpty($this->getRequest()->getUrl());
        var_dump($this->getRequest()->getUrl());
    }

}
