<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\RequestFactory;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;

trait RequestFactoryTestTrait
{

    private $requestFactory;

    private function callBuildRequest(): Request
    {
        return $this->getRequestFactory()->buildRequest(
                   'AssignedName',
                   'AssignedContainer',
                   'http://assigned.url/'
               );
    }

    public function testBuildRequestReturnsARequestImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                Request::class,
                $this->callBuildRequest()
            )
        );
    }

    public function testBuildRequestStoresTheRequestImplementationInstanceItBuilds(): void
    {
        $request = $this->callBuildRequest();
        $this->assertTrue($this->wasStoredOnBuild($request));
    }

    public function testBuildRequestRegistersTheRequestImplementationInstanceItBuilds(): void
    {
        $request = $this->callBuildRequest();
        $this->assertTrue($this->wasRegisteredOnBuild($request));
    }

    /**
    public function testBuildRequestReturnsRequestWhoseNameMatchesSuppliedName(): void
    {
        $expectedName = 'ExpectedName';
        $request = $this->getRequestFactory()->buildRequest($expectedName, 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertEquals(
            $expectedName,
            $request->getName(),
        );
    }

    public function testBuildRequestReturnsRequestWhoseContainerMatchesSuppliedContainer(): void
    {
        $expectedContainer = 'ExpectedContainer';
        $request = $this->getRequestFactory()->buildRequest('AssignedName', $expectedContainer, 'Assigned Output', 420.87);
        $this->assertEquals(
            $expectedContainer,
            $request->getContainer(),
        );
    }

    public function testBuildRequestReturnsRequestWhoseOutputMatchesSuppliedOutput(): void
    {
        $expectedOutput = 'Expected output';
        $request = $this->getRequestFactory()->buildRequest('AssignedName', 'AssignedContainer', $expectedOutput, 420.87);
        $this->assertEquals(
            $expectedOutput,
            $request->getOutput(),
        );
    }

    public function testBuildRequestReturnsRequestWhosePositionMatchesSuppliedPosition(): void
    {
        $expectedPosition = 420.87;
        $request = $this->getRequestFactory()->buildRequest('AssignedName', 'AssignedContainer', 'Assigned output', $expectedPosition);
        $this->assertEquals(
            $expectedPosition,
            $request->getPosition(),
        );
    }


     */

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
