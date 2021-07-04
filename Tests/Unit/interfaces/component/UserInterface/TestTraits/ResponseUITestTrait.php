<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\UserInterface\ResponseUI as ResponseUIInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StorageDriver as StorageDriverInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\component\Web\Routing\Router as CoreRouter;
use DarlingDataManagementSystem\classes\component\Web\Routing\Response as CoreResponse;
use DarlingDataManagementSystem\classes\component\Driver\Storage\StorageDriver as CoreStorageDriver;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use RuntimeException as PHPRuntimeException;

trait ResponseUITestTrait
{

    protected ResponseUIInterface $responseUI;

    public static function generateTestOutputComponent(): OutputComponentInterface
    {
        $outputComponent = new CoreOutputComponent(
             new CoreStorable(
                'TestOutputComponent' . strval(rand(1000,9999)),
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable(rand(100, 999)),
        );
        $outputComponent->import([
            'output' => PHP_EOL . 'OC ID: ' . $outputComponent->getUniqueId() . PHP_EOL . 'OC NAME: ' . $outputComponent->getName() . PHP_EOL
        ]);
        return $outputComponent;
    }

    public static function generateTestResponse(): ResponseInterface
    {
        $response = new CoreResponse(
             new CoreStorable(
                'TestResponse',
                self::expectedAppLocation(),
                ResponseInterface::RESPONSE_CONTAINER,
            ),
            new CoreSwitchable(),
            new CorePositionable(rand(0,100)),
        );
        $request = self::getRequest();
        self::getComponentCrud()->create($request);
        $response->addRequestStorageInfo($request);
        for($i=0; $i < rand(10,100); $i++)
        {
            $outputComponent = self::generateTestOutputComponent();
            self::getComponentCrud()->create($outputComponent);
            $response->addOutputComponentStorageInfo($outputComponent);
        }
        return $response;
    }

    public static function setUpBeforeClass(): void
    {
        self::getComponentCrud()->create(self::generateTestResponse());
    }

    /**
     * @return array<ComponentInterface>
     */
    protected static function readAllFromContainer(string $container): array
    {
        return self::getComponentCrud()->readAll(self::expectedAppLocation(), self::getTestComponentContainer());
    }

    protected static function deleteAllInContainer(string $container): void
    {
        foreach(self::getComponentCrud()->readAll(self::expectedAppLocation(), $container) as $storable)
        {
            self::getComponentCrud()->delete($storable);
        }
    }

    public static function tearDownAfterClass(): void
    {
        self::deleteAllInContainer(self::getTestComponentContainer());
        self::deleteAllInContainer(ResponseInterface::RESPONSE_CONTAINER);
    }

    protected function setResponseUIParentTestInstances(): void
    {
        $this->setOutputComponent($this->getResponseUI());
        $this->setOutputComponentParentTestInstances();
    }

    public function getResponseUI(): ResponseUIInterface
    {
        return $this->responseUI;
    }

    public function setResponseUI(ResponseUIInterface $responseUI): void
    {
        $this->responseUI = $responseUI;
    }

    /**
     * @return array{0: StorableInterface, 1: SwitchableInterface, 2: PositionableInterface, 3: RouterInterface}
     */
    public function getResponseUITestArgs(): array
    {
        return [
            new CoreStorable(
                'MockResponseUIName',
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable(),
            self::getRouter()
        ];
    }

    public function testGetRouterTestMethodReturnsARouterImplemnetationInstance(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                RouterInterface::class,
                self::getRouter()
            )
        );
    }

    public static function getRouter(): RouterInterface
    {
        return new CoreRouter(
            new CoreStorable(
                'ResponseUITestRouter' . strval(rand(0, 999)),
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable(),
            self::getRequest(),
            self::getComponentCrud()
        );
    }

    protected static function expectedAppLocation(): string
    {
        return CoreApp::deriveAppLocationFromRequest(self::getIndependantTestRequest());
    }

    protected static function getTestComponentContainer(): string
    {
        return 'TestComponents';
    }

    public static function getIndependantTestRequest(): RequestInterface
    {
        $request =  new CoreRequest(
            new CoreStorable(
                'ResponseUICurrentRequest' . strval(rand(0, 999)),
                'TestUrls',
                self::getTestComponentContainer()
            ),
            new CoreSwitchable()
        );
        return $request;
    }

    public static function getRequest(): RequestInterface
    {
        return new CoreRequest(
            new CoreStorable(
                'ResponseUICurrentRequest' . strval(rand(0, 999)),
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable()
        );
    }

    protected static function getComponentCrud(): ComponentCrudInterface
    {
        return new CoreComponentCrud(
            new CoreStorable(
                'ResponseUITestComponentCrudForResponseUITestRouter' . strval(rand(0, 999)),
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable(),
            self::getStandardStorageDriver()
        );
    }

    protected static function getStandardStorageDriver(): StorageDriverInterface
    {
        return new CoreStorageDriver(
            new CoreStorable(
                'ResponseUITestStorageDriver' . strval(rand(0, 999)),
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable()
        );
    }

    public function testRouterPropertyIsAssignedARouterImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            $this->isProperImplementation(
                RouterInterface::class,
                $this->getResponseUI()->export()['router']
            )
        );
    }

    /**
     * @return array<ResponseInterface>
     */
    protected function expectedResponses(): array
    {
        return $this->getResponseUI()->export()['router']->getResponses(
            self::expectedAppLocation(),
            ResponseInterface::RESPONSE_CONTAINER
        );
    }

    /**
     * @return array<PositionableInterface>
     */
    protected function sortPositionables(PositionableInterface ...$postionables): array
    {
        $sorted = [];
        foreach($postionables as $postionable) {
            while(isset($sorted[strval($postionable->getPosition())]))
            {
                $postionable->increasePosition();
            }
            $sorted[strval($postionable->getPosition())] = $postionable;
        }
        ksort($sorted, SORT_NUMERIC);
        return $sorted;
    }

    protected function getRoutersCompoenentCrud(): ComponentCrudInterface
    {
         return $this->getResponseUI()->export()['router']->export()['crud'];
    }

    protected function expectedOutput(): string
    {
        $expectedOutput = '';
        $expectedResponses = $this->expectedResponses();
        $sortedResponses = $this->sortPositionables(...$expectedResponses);;
        /**
         * @var ResponseInterface $response
         */
        foreach($sortedResponses as $response)
        {
            $outputComponents = [];
            foreach($response->getOutputComponentStorageInfo() as $storable)
            {
                /**
                 * @var OutputComponentInterface $component
                 */
                $component = $this->getRoutersCompoenentCrud()->read($storable);
                if($this->isProperImplementation(OutputComponentInterface::class, $component))
                {
                    array_push($outputComponents, $component);
                }
            }
            $sortedOutputComponents = $this->sortPositionables(...$outputComponents);
            /**
             * @var OutputComponentInterface $outputComponent
             */
            foreach($sortedOutputComponents as $outputComponent)
            {
                $expectedOutput .= $outputComponent->getOutput();
            }
        }
        return $expectedOutput;
    }

    public function testGetOutputReturnsCollectiveOutputFromAllResponsesReturnedByRouterSortedByResponsePositionThenOutputComponentPosition(): void
    {
        $this->assertEquals(
            $this->expectedOutput(),
            $this->getResponseUI()->getOutput()
        );
    }

    public function testGetOutputThrowsRuntimeExceptionIfOutputIsEmpty(): void
    {
        self::tearDownAfterClass();
        $this->expectException(PhpRuntimeException::class);
        $this->getResponseUI()->getOutput();
    }

    public function testGetRouterReturnsAssignedRouter(): void
    {
        $this->assertEquals(
            $this->getResponseUI()->export()['router'],
            $this->getResponseUI()->getRouter()
        );
    }
}
