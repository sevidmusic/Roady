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
        return new CoreStandardUITemplate(
            $this->getResponseFactory()->getPrimaryFactory()->buildStorable(
                'TestStandardUITemplate',
                'TestTemplates'
            ),
            $this->getResponseFactory()->getPrimaryFactory()->buildSwitchable(),
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable(420.87)
        );
    }

    private function buildBuildResponseTestArguments(): array
    {
        return [
            'AssignedName',
            420.87,
            $this->buildTestRequest(),
            $this->buildTestOutputComponent(),
            $this->buildTestStandardUITemplate(),
            $this->buildTestAction()
        ];
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

    /**
    public function testBuildResponseStoresTheResponseImplementationInstanceItBuilds(): void
    {
        $response = $this->getResponseFactory()->buildResponse('AssignedName', 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertTrue($this->wasStoredOnBuild($response));
    }

    public function testBuildResponseRegistersTheResponseImplementationInstanceItBuilds(): void
    {
        $response = $this->getResponseFactory()->buildResponse('AssignedName', 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertTrue($this->wasRegisteredOnBuild($response));
    }

    public function testBuildResponseReturnsResponseWhoseNameMatchesSuppliedName(): void
    {
        $expectedName = 'ExpectedName';
        $response = $this->getResponseFactory()->buildResponse($expectedName, 'AssignedContainer', 'Assigned Output', 420.87);
        $this->assertEquals(
            $expectedName,
            $response->getName(),
        );
    }

    public function testBuildResponseReturnsResponseWhoseContainerMatchesSuppliedContainer(): void
    {
        $expectedContainer = 'ExpectedContainer';
        $response = $this->getResponseFactory()->buildResponse('AssignedName', $expectedContainer, 'Assigned Output', 420.87);
        $this->assertEquals(
            $expectedContainer,
            $response->getContainer(),
        );
    }

    public function testBuildResponseReturnsResponseWhoseOutputMatchesSuppliedOutput(): void
    {
        $expectedOutput = 'Expected output';
        $response = $this->getResponseFactory()->buildResponse('AssignedName', 'AssignedContainer', $expectedOutput, 420.87);
        $this->assertEquals(
            $expectedOutput,
            $response->getOutput(),
        );
    }

    public function testBuildResponseReturnsResponseWhosePositionMatchesSuppliedPosition(): void
    {
        $expectedPosition = 420.87;
        $response = $this->getResponseFactory()->buildResponse('AssignedName', 'AssignedContainer', 'Assigned output', $expectedPosition);
        $this->assertEquals(
            $expectedPosition,
            $response->getPosition(),
        );
    }
     */

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
