<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingDataManagementSystem\interfaces\component\Factory\RequestFactory;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;

trait RequestFactoryTestTrait
{

    private $requestFactory;
    private $expectedName = 'expectedName';
    private $expectedContainer = 'expectedContainer';
    private $expectedUrl = 'expectedUrl';

    public function testBuildRequestReturnsARequestImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                Request::class,
                $this->callBuildRequest()
            )
        );
    }

    private function callBuildRequest(): Request
    {
        return $this->getRequestFactory()->buildRequest(
            $this->expectedName,
            $this->expectedContainer,
            $this->expectedUrl
        );
    }

    protected function getRequestFactory(): RequestFactory
    {
        return $this->requestFactory;
    }

    protected function setRequestFactory(RequestFactory $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
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

}
