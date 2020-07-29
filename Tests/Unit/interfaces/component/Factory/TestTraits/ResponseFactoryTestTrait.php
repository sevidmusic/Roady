<?php

namespace UnitTests\interfaces\component\Factory\TestTraits;

use DarlingCms\interfaces\component\Factory\ResponseFactory;
use DarlingCms\classes\component\Factory\ResponseFactory as CoreResponseFactory;
use DarlingCms\interfaces\component\Web\Routing\Response;
use DarlingCms\interfaces\component\Web\Routing\GlobalResponse;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\Action;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\Routing\Response as CoreResponse;
use DarlingCms\classes\component\Web\Routing\GlobalResponse as CoreGlobalResponse;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;
use DarlingCms\classes\component\OutputComponent as CoreOutputComponent;
use DarlingCms\classes\component\Action as CoreAction;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate as CoreStandardUITemplate;

trait ResponseFactoryTestTrait
{

    private $responseFactory;
    private $expectedResponseName = 'ExpectedResponseName';
    private $expectedPosition = 420.87;
    private $expectedNumberOfRequests = 29;
    private $expectedNumberOfStandardUITemplates = 23;
    private $expectedNumberOfOutputComponents = 27;
    private $expectedNumberOfActions = 42;

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
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable($this->expectedPosition)
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
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable($this->expectedPosition)
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
            $this->getResponseFactory()->getPrimaryFactory()->buildPositionable($this->expectedPosition)
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

    public function testBuildResponseReturnsResponseWhoseAssignedStandardUITemplateCountMatchesExpectedStandardUITemplateCount(): void
    {
        $response = $this->callBuildResponse();
        $this->assertEquals(
            $this->expectedNumberOfStandardUITemplates,
            count($response->getTemplateStorageInfo())
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
            $this->buildTestStandardUITemplate(),
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

    public function testIfStandardUITemplateAddStorageInfoAddsStandardUITemplatesStorableToResponse(): void
    {
        $response = $this->callBuildResponse();
        $standardUITemplate = $this->buildTestStandardUITemplate();
        CoreResponseFactory::ifStandardUITemplateAddStorageInfo(
            $response,
            $standardUITemplate
        );
        $this->assertTrue(
            in_array(
                $standardUITemplate->export()['storable'],
                $response->getTemplateStorageInfo()
            )
        );
    }

    public function testIfStandardUITemplateAddStorageInfoIgnoresComponentsThatAreNotStandardUITemplates(): void
    {
        $components = [
            $this->buildTestRequest(),
            $this->buildTestOutputComponent(),
            $this->buildTestAction()
        ];
        $response = $this->callBuildResponse();
        $component = $components[array_rand($components)];
        CoreResponseFactory::ifStandardUITemplateAddStorageInfo(
            $response,
            $component
        );
        $this->assertFalse(
            in_array(
                $component->export()['storable'],
                $response->getTemplateStorageInfo()
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
            $this->buildTestStandardUITemplate(),
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

    private function callBuildGlobalResponse(): Response
    {
        $args = [$this->expectedResponseName, $this->expectedPosition];
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
        $globalResponse = $this->getResponseFactory()->buildGlobalResponse(
            ...$args
        );
        return $globalResponse;
    }

    public function testBuildGlobalResponseReturnsAGlobalResponseImplementationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                GlobalResponse::class,
                $this->callBuildGlobalResponse()
            )
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

    public function testBuildGlobalResponseReturnsResponseWhoseAssignedStandardUITemplateCountMatchesExpectedStandardUITemplateCount(): void
    {
        $response = $this->callBuildGlobalResponse();
        $this->assertEquals(
            $this->expectedNumberOfStandardUITemplates,
            count($response->getTemplateStorageInfo())
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

    protected function getResponseFactory(): ResponseFactory
    {
        return $this->responseFactory;
    }

    protected function setResponseFactory(ResponseFactory $responseFactory): void
    {
        $this->responseFactory = $responseFactory;
    }

}
