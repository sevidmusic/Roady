<?php /** @noinspection PhpUndefinedMethodInspection */

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use DarlingCms\interfaces\component\Web\Routing\Request;

trait RequestTestTrait
{

    private $request;

    public function testGetGetReturnsGetArray(): void
    {
        $this->turnRequestOn();
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getArrayTestUtility()->arraysAreEqual($_GET, $this->getRequest()->getGet());
    }

    private function turnRequestOn(): void
    {
        if ($this->getRequest()->getState() === false) {
            $this->getRequest()->switchState();
        }
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /** @noinspection PhpUndefinedMethodInspection */
    public function testGetPostReturnsPostArray(): void
    {
        $this->turnRequestOn();
        $this->getArrayTestUtility()->arraysAreEqual($_POST, $this->getRequest()->getPost());
    }

    public function testCanGetUrl(): void
    {
        $this->turnRequestOn();
        $this->setMockUrl();
        $this->getStringTestUtility()->stringIsNotEmpty($this->getRequest()->getUrl());
        $this->assertEquals(
            'https://www.example.com/',
            $this->getRequest()->getUrl(),
            'getUrl() must return the assigned url.'
        );
    }

    private function setMockUrl(): void
    {
        $this->getRequest()->import(['url' => 'https://www.example.com/']);
    }

    public function testGetPostReturnsEmptyArrayIfStateIsFalse(): void
    {
        $this->turnRequestOff();
        $this->setMockPostVars();
        $this->assertEmpty(
            $this->getRequest()->getPost(),
            'getPost() must return an empty array if state is false.'
        );
    }

    private function turnRequestOff(): void
    {
        if ($this->getRequest()->getState() === true) {
            $this->getRequest()->switchState();
        }
    }

    private function setMockPostVars(): void
    {
        $this->getRequest()->import(['post' => ['postFoo' => 'postBar']]);
    }

    public function testGetGetReturnsEmptyArrayIfStateIsFalse(): void
    {
        $this->turnRequestOff();
        $this->setMockGetVars();
        $this->assertEmpty(
            $this->getRequest()->getGet(),
            'getGet() must return an empty array if state is false.'
        );
    }

    private function setMockGetVars(): void
    {
        $this->getRequest()->import(['get' => ['getFoo' => 'getBar']]);
    }

    public function testGetUrlReturns__DISABLED__IfStateIsFalse(): void
    {
        $this->turnRequestOff();
        $this->assertEquals(
            '__DISABLED__',
            $this->getRequest()->getUrl(),
            'getUrl() must return the string __DISABLED__ if state is false.'
        );
    }

    protected function setRequestParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getRequest());
        $this->setSwitchableComponentParentTestInstances();
    }

}
