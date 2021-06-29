<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingDataManagementSystem\classes\component\Action as CoreAction;
use DarlingDataManagementSystem\classes\component\Factory\ResponseFactory as CoreResponseFactory;
use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\classes\component\Web\Routing\GlobalResponse as CoreGlobalResponse;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\component\Web\Routing\Response as CoreResponse;
use DarlingDataManagementSystem\interfaces\component\Action as ActionInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;

trait ResponseFactoryTestTrait
{

    private ResponseFactoryInterface $responseFactory;
    private string $expectedResponseName = 'ExpectedResponseName';
    private float $expectedPosition = 420.87;
    private int $expectedNumberOfRequests = 29;
    private int $expectedNumberOfOutputComponents = 27;
    private int $expectedNumberOfActions = 42;

    public function testBuildResponseReturnsAResponseImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                ResponseInterface::class,
                $this->callBuildResponse()
            )
        );
    }

    private function callBuildResponse(): ResponseInterface
    {
        return $this->getResponseFactory()->buildResponse(
            ...$this->buildBuildResponseTestArguments()
        );
    }

    protected function getResponseFactory(): ResponseFactoryInterface
    {
        return $this->responseFactory;
    }

    protected function setResponseFactory(ResponseFactoryInterface $responseFactory): void
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @return array<mixed>
     */
    private function buildBuildResponseTestArguments(): array
    {
        $args = [
            $this->expectedResponseName,
            $this->expectedPosition,
        ];
        for ($i = 0; $i < $this->expectedNumberOfRequests; $i++) {
            array_push($args, $this->buildTestRequest());
        }
        for ($i = 0; $i < $this->expectedNumberOfOutputComponents; $i++) {
            array_push($args, $this->buildTestOutputComponent());
        }
        for ($i = 0; $i < $this->expectedNumberOfActions; $i++) {
            array_push($args, $this->buildTestAction());
        }
        return $args;
    }

    private function buildTestRequest(): RequestInterface
    {
        return new CoreRequest(
            $this->getResponseFactory()->getPrimaryFactory()->buildStorable(
                'TestRequest',
                'TestRequests'
            ),
            $this->getResponseFactory()->getPrimaryFactory()->buildSwitchable()
        );
    }

    private function buildTestOutputComponent(): OutputComponentInterface
    {
        return new CoreOutputComponent(
            $this->getResponseFactory()->getPrimaryFactory()->buildStorable(
                'TestOutputComponent',
                'TestOutputComponents'
            ),
            $this->getResponseFactory()->getPrimaryFactory()->buildSwitchable(),
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable($this->expectedPosition)
        );
    }

    private function buildTestAction(): ActionInterface
    {
        return new CoreAction(
            $this->getResponseFactory()->getPrimaryFactory()->buildStorable(
                'ResponseFactoryTestAction',
                'TestActions'
            ),
            $this->getResponseFactory()->getPrimaryFactory()->buildSwitchable(),
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable($this->expectedPosition)
        );
    }

    public function testBuildResponseStoresTheResponseImplementationInstanceItBuilds(): void
    {
        $response = $this->callBuildResponse();
        $this->assertTrue($this->wasStoredOnBuild($response));
    }

    public function testBuildResponseRegistersTheResponseImplementationInstanceItBuilds(): void
    {
        $response = $this->callBuildResponse();
        $this->assertTrue($this->wasRegisteredOnBuild($response));
    }

    public function testBuildResponseReturnsResponseWhoseNameMatchesSuppliedName(): void
    {
        $response = $this->callBuildResponse();
        $this->assertEquals(
            $this->expectedResponseName,
            $response->getName(),
        );
    }

    public function testBuildResponseReturnsResponseWhoseContainerMatchesResponseRESPONSE_CONTAINERConstant(): void
    {
        $response = $this->callBuildResponse();
        $this->assertEquals(
            CoreResponse::RESPONSE_CONTAINER,
            $response->getContainer(),
        );
    }

    public function testBuildResponseReturnsResponseWhosePositionMatchesSuppliedPosition(): void
    {
        $response = $this->callBuildResponse();
        $this->assertEquals(
            $this->expectedPosition,
            $response->getPosition(),
        );
    }

    public function testBuildResponseReturnsResponseWhoseAssignedRequestCountMatchesExpectedRequestCount(): void
    {
        $response = $this->callBuildResponse();
        $this->assertEquals(
            $this->expectedNumberOfRequests,
            count($response->getRequestStorageInfo())
        );
    }

    public function testBuildResponseReturnsResponseWhoseAssignedOutputComponentCountMatchesExpectedOutputComponentCount(): void
    {
        $response = $this->callBuildResponse();
        $this->assertEquals(
            ($this->expectedNumberOfOutputComponents + $this->expectedNumberOfActions),
            count($response->getOutputComponentStorageInfo())
        );
    }

    public function testIfRequestAddStorageInfoAddsRequestsStorableToResponse(): void
    {
        $response = $this->callBuildResponse();
        $request = $this->buildTestRequest();
        CoreResponseFactory::ifRequestAddStorageInfo(
            $response,
            $request
        );
        $this->assertTrue(
            in_array(
                $request->export()['storable'],
                $response->getRequestStorageInfo()
            )
        );
    }

    public function testIfRequestAddStorageInfoIgnoresComponentsThatAreNotRequests(): void
    {
        $components = [
            $this->buildTestOutputComponent(),
            $this->buildTestAction()
        ];
        $response = $this->callBuildResponse();
        $component = $components[array_rand($components)];
        CoreResponseFactory::ifRequestAddStorageInfo(
            $response,
            $component
        );
        $this->assertFalse(
            in_array(
                $component->export()['storable'],
                $response->getRequestStorageInfo()
            )
        );
    }

    public function testIfOutputComponentAddStorageInfoAddsOutputComponentsStorableToResponse(): void
    {
        $response = $this->callBuildResponse();
        $outputComponents = [$this->buildTestOutputComponent(), $this->buildTestAction()];
        $outputComponent = $outputComponents[array_rand($outputComponents)];
        CoreResponseFactory::ifOutputComponentAddStorageInfo(
            $response,
            $outputComponent
        );
        $this->assertTrue(
            in_array(
                $outputComponent->export()['storable'],
                $response->getOutputComponentStorageInfo()
            )
        );
    }


    public function testIfOutputComponentAddStorageInfoIgnoresComponentsThatAreNotOutputComponents(): void
    {
        $components = [
            $this->buildTestRequest(),
        ];
        $response = $this->callBuildResponse();
        $component = $components[array_rand($components)];
        CoreResponseFactory::ifOutputComponentAddStorageInfo(
            $response,
            $component
        );
        $this->assertFalse(
            in_array(
                $component->export()['storable'],
                $response->getOutputComponentStorageInfo()
            )
        );
    }

    public function testBuildGlobalResponseReturnsAGlobalResponseImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                GlobalResponseInterface::class,
                $this->callBuildGlobalResponse()
            )
        );
    }

    private function callBuildGlobalResponse(): ResponseInterface
    {
        return $this->getResponseFactory()->buildGlobalResponse(
            ...$this->buildBuildResponseTestArguments()
        );
    }

    public function testBuildGlobalResponseStoresTheResponseImplementationInstanceItBuilds(): void
    {
        $response = $this->callBuildGlobalResponse();
        $this->assertTrue($this->wasStoredOnBuild($response));
    }

    public function testBuildGlobalResponseRegistersTheResponseImplementationInstanceItBuilds(): void
    {
        $response = $this->callBuildGlobalResponse();
        $this->assertTrue($this->wasRegisteredOnBuild($response));
    }

    public function testBuildGlobalResponseReturnsResponseWhoseContainerMatchesGlobalResponseRESPONSE_CONTAINERConstant(): void
    {
        $response = $this->callBuildGlobalResponse();
        $this->assertEquals(
            CoreGlobalResponse::RESPONSE_CONTAINER,
            $response->getContainer(),
        );
    }

    public function testBuildGlobalResponseReturnsResponseWhosePositionMatchesSuppliedPosition(): void
    {
        $response = $this->callBuildGlobalResponse();
        $this->assertEquals(
            $this->expectedPosition,
            $response->getPosition(),
        );
    }

    public function testBuildGlobalResponseReturnsResponseWhoseNameMatchesSuppliedName(): void
    {
        $response = $this->callBuildGlobalResponse();
        $this->assertEquals(
            $this->expectedResponseName,
            $response->getName(),
        );
    }

    public function testBuildGlobalResponseReturnsResponseWhoseAssignedOutputComponentCountMatchesExpectedOutputComponentCount(): void
    {
        $response = $this->callBuildGlobalResponse();
        $this->assertEquals(
            ($this->expectedNumberOfOutputComponents + $this->expectedNumberOfActions),
            count($response->getOutputComponentStorageInfo())
        );
    }

    protected function setResponseFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getResponseFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

}
