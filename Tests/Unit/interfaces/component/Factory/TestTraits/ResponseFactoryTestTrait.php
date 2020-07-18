<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\ResponseFactory;
use DarlingCms\interfaces\component\Web\Routing\Response;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\Action;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\Routing\Response as CoreResponse;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;
use DarlingCms\classes\component\OutputComponent as CoreOutputComponent;
use DarlingCms\classes\component\Action as CoreAction;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate as CoreStandardUITemplate;

trait ResponseFactoryTestTrait
{

    private $responseFactory;
    private $expectedResponseName = 'ExpectedResponseName';
    private $expectedContainer = CoreResponse::RESPONSE_CONTAINER;
    private $expectedPosition = 420.87;
    private $expectedNumberOfRequests = 2;
    private $expectedNumberOfStandardUITemplates = 2;
    private $expectedNumberOfOutputComponents = 2;
    private $expectedNumberOfActions = 2;

    private function buildTestRequest(): Request
    {
        return new CoreRequest(
            $this->getResponseFactory()->getPrimaryFactory()->buildStorable(
                'TestRequest',
                'TestRequests'
            ),
            $this->getResponseFactory()->getPrimaryFactory()->buildSwitchable()
        );
    }

    private function buildTestOutputComponent(): OutputComponent
    {
        return new CoreOutputComponent(
            $this->getResponseFactory()->getPrimaryFactory()->buildStorable(
                'TestOutputComponent',
                'TestOutputComponents'
            ),
            $this->getResponseFactory()->getPrimaryFactory()->buildSwitchable(),
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable(420.87)
        );
    }

    private function buildTestAction(): Action
    {
        return new CoreAction(
            $this->getResponseFactory()->getPrimaryFactory()->buildStorable(
                'TestAction',
                'TestActions'
            ),
            $this->getResponseFactory()->getPrimaryFactory()->buildSwitchable(),
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable(420.87)
        );
    }

    private function buildTestStandardUITemplate(): StandardUITemplate
    {
        $suit = new CoreStandardUITemplate(
            $this->getResponseFactory()->getPrimaryFactory()->buildStorable(
                'TestStandardUITemplate',
                'TestTemplates'
            ),
            $this->getResponseFactory()->getPrimaryFactory()->buildSwitchable(),
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable(420.87)
        );
        $suit->addType($this->buildTestOutputComponent());
        $suit->addType($this->buildTestAction());
        return $suit;
    }

    private function buildBuildResponseTestArguments(): array
    {
        $args = [
            $this->expectedResponseName,
            $this->expectedPosition,
        ];
        for($i=0;$i < $this->expectedNumberOfRequests; $i++)
        {
            array_push($args, $this->buildTestRequest());
        }
        for($i=0;$i < $this->expectedNumberOfStandardUITemplates; $i++)
        {
            array_push($args, $this->buildTestStandardUITemplate());
        }
        for($i=0;$i < $this->expectedNumberOfOutputComponents; $i++)
        {
            array_push($args, $this->buildTestOutputComponent());
        }
        for($i=0;$i < $this->expectedNumberOfActions; $i++)
        {
            array_push($args, $this->buildTestAction());
        }
        return $args;
    }

    private function callBuildResponse(): Response
    {
        return $this->getResponseFactory()->buildResponse(
            ...$this->buildBuildResponseTestArguments()
        );
    }

    public function testBuildResponseReturnsAResponseImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                Response::class,
                $this->callBuildResponse()
            )
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

    public function testBuildResponseReturnsResponseWhoseContainerMatchesSuppliedContainer(): void
    {
        $response = $this->callBuildResponse();
        $this->assertEquals(
            $this->expectedContainer,
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

    public function testBuildResponseReturnsResponseWhoseAssignedStandardUITemplateCountMatchesExpectedStandardUITemplateCount(): void
    {
        $response = $this->callBuildResponse();
        $this->assertEquals(
            $this->expectedNumberOfStandardUITemplates,
            count($response->getTemplateStorageInfo())
        );
    }

    protected function setResponseFactoryParentTestInstances(): void
    {
        $this->setStoredComponentFactory($this->getResponseFactory());
        $this->setStoredComponentFactoryParentTestInstances();
    }

    protected function getResponseFactory(): ResponseFactory
    {
        return $this->responseFactory;
    }

    protected function setResponseFactory(ResponseFactory $responseFactory): void
    {
        $this->responseFactory = $responseFactory;
    }

}
