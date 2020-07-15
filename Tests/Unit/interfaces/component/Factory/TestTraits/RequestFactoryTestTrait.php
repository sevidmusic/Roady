<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\RequestFactory;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;

trait RequestFactoryTestTrait
{

    private $requestFactory;

    public function testBuildRequestReturnsARequestImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                Request::class,
                $this->getRequestFactory()->buildRequest(
                    'AssignedName',
                    'AssignedContainer',
                    'http://assigned.url/'
                )
            )
        );
    }

    /**


    public function testBuildRequestStoresTheRequestImplementationInstanceItBuilds(): void
    {
        $outputComponent = $this->getRequestFactory()->buildRequest('AssignedName', 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertTrue($this->wasStoredOnBuild($outputComponent));
    }

    public function testBuildRequestRegistersTheRequestImplementationInstanceItBuilds(): void
    {
        $outputComponent = $this->getRequestFactory()->buildRequest('AssignedName', 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertTrue($this->wasRegisteredOnBuild($outputComponent));
    }

    public function testBuildRequestReturnsRequestWhoseNameMatchesSuppliedName(): void
    {
        $expectedName = 'ExpectedName';
        $outputComponent = $this->getRequestFactory()->buildRequest($expectedName, 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertEquals(
            $expectedName,
            $outputComponent->getName(),
        );
    }

    public function testBuildRequestReturnsRequestWhoseContainerMatchesSuppliedContainer(): void
    {
        $expectedContainer = 'ExpectedContainer';
        $outputComponent = $this->getRequestFactory()->buildRequest('AssignedName', $expectedContainer, 'Assigned Output', 420.87);
        $this->assertEquals(
            $expectedContainer,
            $outputComponent->getContainer(),
        );
    }

    public function testBuildRequestReturnsRequestWhoseOutputMatchesSuppliedOutput(): void
    {
        $expectedOutput = 'Expected output';
        $outputComponent = $this->getRequestFactory()->buildRequest('AssignedName', 'AssignedContainer', $expectedOutput, 420.87);
        $this->assertEquals(
            $expectedOutput,
            $outputComponent->getOutput(),
        );
    }

    public function testBuildRequestReturnsRequestWhosePositionMatchesSuppliedPosition(): void
    {
        $expectedPosition = 420.87;
        $outputComponent = $this->getRequestFactory()->buildRequest('AssignedName', 'AssignedContainer', 'Assigned output', $expectedPosition);
        $this->assertEquals(
            $expectedPosition,
            $outputComponent->getPosition(),
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
