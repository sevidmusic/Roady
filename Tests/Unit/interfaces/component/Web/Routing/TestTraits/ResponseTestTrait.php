<?php

namespace UnitTests\interfaces\component\Web\Routing\TestTraits;

use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Web\Routing\Response;

trait ResponseTestTrait
{

    private $response;

    public function testAddRequestAddsSpecifiedRequest()
    {
        $initialRequestCount = count($this->getResponse()->export()['requests']);
        $this->getResponse()->addRequest($this->getMockRequest());
        $this->assertTrue((count($this->getResponse()->export()['requests']) > $initialRequestCount));
    }

    private function getMockRequest(): Request
    {
        $request = new Request($this->getMockStorable(), $this->getMockSwitchable());
        $request->import(
            [
                'url' => 'http://www.example.com/admin.php?foo=bar&baz=bazzer',
                'get' => [
                    'foo' => 'bar',
                    'baz' => 'bazzer'
                ],
                'post' => [
                    'foobarbaz'
                ]
            ]
        );
        return $request;
    }

    private function getMockStorable(): Storable
    {
        return new Storable('MockName', 'MockLocation', 'MockContainer');
    }

    private function getMockSwitchable(): Switchable
    {
        return new Switchable();
    }

    public function testRemoveRequestRemovesSpecifiedRequest(): void
    {
        $request = $this->getMockRequest();
        $this->getResponse()->addRequest($request);
        $requestCount = count($this->getResponse()->export()['requests']);
        $this->getResponse()->removeRequest($request->getName());
        $this->assertTrue((count($this->getResponse()->export()['requests']) < $requestCount), 'Failed removing request by name');
        $this->getResponse()->addRequest($request);
        $requestCount = count($this->getResponse()->export()['requests']);
        $this->getResponse()->removeRequest($request->getUniqueId());
        $this->assertTrue((count($this->getResponse()->export()['requests']) < $requestCount), 'Failed removing request by id.');

    }

    public function testRespondsToRequestReturnsTrueForAssignedRequest(): void
    {
        $request = $this->getMockRequest();
        $this->getResponse()->addRequest($request);
        $this->assertTrue($this->getResponse()->respondsToRequest($request));
    }

    public function testRespondsToRequestReturnsFalseForUnknownRequest(): void
    {
        $this->assertFalse($this->getResponse()->respondsToRequest($this->getMockRequest()));
    }

    public function testAddOutputComponentStorageInfoAddsSpecifiedOutputComponentsStorableInstance(): void
    {
        $initialCount = count($this->getResponse()->export()['outputComponentStorageInfo']);
        $this->getResponse()->addOutputComponentStorageInfo($this->getMockOutputComponent());
        $this->assertTrue((count($this->getResponse()->export()['outputComponentStorageInfo']) > $initialCount));
    }

    private function getMockOutputComponent(): OutputComponent
    {
        return new OutputComponent($this->getMockStorable(), $this->getMockSwitchable());
    }

    public function testRemoveOutputComponentStorageInfoRemovesSpecifiedOutputComponentsStorableInstance(): void
    {
        $outputComponent = $this->getMockOutputComponent();
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $count = count($this->getResponse()->export()['outputComponentStorageInfo']);
        $this->getResponse()->removeOutputComponentStorageInfo($outputComponent->getName());
        $this->assertTrue((count($this->getResponse()->export()['outputComponentStorageInfo']) < $count), 'Failed removing output component storage info by name');
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $count = count($this->getResponse()->export()['outputComponentStorageInfo']);
        $this->getResponse()->removeOutputComponentStorageInfo($outputComponent->getUniqueId());
        $this->assertTrue((count($this->getResponse()->export()['outputComponentStorageInfo']) < $count), 'Failed removing output component storage info by unique id');
    }

    public function testGetOutputComponentStorageInfoReturnsArrayOfStorableInstancesForAssignedOutputComponents()
    {
        $outputComponent = $this->getMockOutputComponent();
        $this->getResponse()->addOutputComponentStorageInfo($outputComponent);
        $this->assertEquals([$outputComponent->export()['storable']], $this->getResponse()->getOutputComponentStorageInfo());
    }

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
