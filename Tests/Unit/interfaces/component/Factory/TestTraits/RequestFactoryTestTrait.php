<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\RequestFactory;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;

trait RequestFactoryTestTrait
{

    private $requestFactory;
    private $expectedName = 'expectedName';
    private $expectedContainer = 'expectedContainer';
    private $expectedUrl = 'expectedUrl';

    private function callBuildRequest(): Request
    {
        return $this->getRequestFactory()->buildRequest(
            $this->expectedName,
            $this->expectedContainer,
            $this->expectedUrl
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

    public function testBuildRequestReturnsRequestWhoseNameMatchesSuppliedName(): void
    {
        $request = $this->callBuildRequest();
        $this->assertEquals(
            $this->expectedName,
            $request->getName(),
        );
    }

    public function testBuildRequestReturnsRequestWhoseContainerMatchesSuppliedContainer(): void
    {
        $request = $this->callBuildRequest();
        $this->assertEquals(
            $this->expectedContainer,
            $request->getContainer(),
        );
    }

    public function testBuildRequestReturnsRequestWhoseUrlMatchesSuppliedUrl(): void
    {
        $request = $this->callBuildRequest();
        $this->assertEquals(
            $this->expectedUrl,
            $request->getUrl(),
        );
    }

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
