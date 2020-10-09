<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingDataManagementSystem\classes\component\Web\App;
use DarlingDataManagementSystem\interfaces\component\Action as ActionInterface;
use DarlingDataManagementSystem\classes\component\Action as CoreAction;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud as CoreComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StandardStorageDriver as StandardStorageDriverInterface;
use DarlingDataManagementSystem\classes\component\Driver\Storage\StandardStorageDriver as CoreStandardStorageDriver;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;
use DarlingDataManagementSystem\classes\component\Template\UserInterface\StandardUITemplate as CoreStandardUITemplate;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\classes\component\Web\Routing\Response as CoreResponse;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\classes\component\Web\Routing\Router as CoreRouter;
use DarlingDataManagementSystem\interfaces\component\UserInterface\StandardUI as StandardUIInterface;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;

trait StandardUITestTrait
{

    private StandardUIInterface $standardUI;
    private RouterInterface $router;
    private RequestInterface $currentRequest;
    private int $generateComponentCalls = 0;

    public function testAppLocationPropertyMatchesAppLocationDerivedFromRoutersRequest(): void
    {
        $this->assertEquals(
            App::deriveNameLocationFromRequest($this->getRouter()->getRequest()),
            $this->getStandardUI()->export()['appLocation']
        );
    }
    public function getStandardUIContainer(): string
    {
        return 'StandardUITestStandardUIContainer';
    }

    public function tearDown(): void
    {
        // @todo : Working on fixing this...
        foreach ($this->getStoredComponents($this->getOutputComponentContainer()) as $storedComponent) {
            $this->getRouter()->getCrud()->delete($storedComponent);
        }
        foreach ($this->getStoredComponents($this->getStandardUITemplateContainer()) as $storedComponent) {
            $this->getRouter()->getCrud()->delete($storedComponent);
        }
        foreach ($this->getStoredComponents($this->getResponseContainer()) as $storedComponent) {
            $this->getRouter()->getCrud()->delete($storedComponent);
        }
        foreach ($this->getStoredComponents($this->getRequestContainer()) as $storedComponent) {
            $this->getRouter()->getCrud()->delete($storedComponent);
        }
    }

    protected function getStoredComponents(string $container): array
    {
        return $this->getRouter()->getCrud()->readAll(
            $this->getComponentLocation(),
            $container
        );
    }

    public function getRouter(): RouterInterface
    {
        if (isset($this->router)) {
            return $this->router;
        }
        $this->router = new CoreRouter(
            new CoreStorable(
                'StandardUITestRouter' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getRouterContainer()
            ),
            new CoreSwitchable(),
            $this->getCurrentRequest(),
            $this->getComponentCrudForRouter()
        );
        return $this->router;
    }

    public function getComponentLocation(): string
    {
        return 'DEFAULT';
    }

    public function getRouterContainer(): string
    {
        return "StandardUITestRouterContainer";
    }

    public function getCurrentRequest(): RequestInterface
    {
        if (isset($this->currentRequest) === true) {
            return $this->currentRequest;
        }
        $this->currentRequest = new CoreRequest(
            new CoreStorable(
                'StandardUICurrentRequest' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getRequestContainer()
            ),
            new CoreSwitchable()
        );
        $this->getRouter()->getCrud()->create($this->currentRequest);
        return $this->currentRequest;
    }

    public function getRequestContainer(): string
    {
        return "StandardUITestRequestContainer";
    }

    private function getComponentCrudForRouter(): ComponentCrudInterface
    {
        if (isset($this->router) === true) {
            return $this->getRouter()->getCrud();
        }
        return new CoreComponentCrud(
            new CoreStorable(
                'StandardUITestComponentCrudForStandardUITestRouter' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getComponentCrudContainer()
            ),
            new CoreSwitchable(),
            $this->getStandardStorageDriverForCrud()
        );
    }

    private function getStandardStorageDriverForCrud(): StandardStorageDriverInterface
    {
        return new CoreStandardStorageDriver(
            new CoreStorable(
                'StandardUITestStorageDriver' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getStandardStorageDriverContainer()
            ),
            new CoreSwitchable()
        );
    }

    public function getComponentCrudContainer(): string
    {
        return "StandardUITestComponentCruds";
    }

    public function getStandardStorageDriverContainer(): string
    {
        return "StandardUITestStorageDrivers";
    }

    public function getOutputComponentContainer(): string
    {
        return "StandardUITestOutputComponentContainer";
    }

    protected function getStandardUITemplateContainer(): string
    {
        return 'StandardUITestStandardUITemplateContainer';
    }

    protected function getResponseContainer(): string
    {
        return ResponseInterface::RESPONSE_CONTAINER;
    }

    public function testRouterPropertyIsAssignedARouterImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                RouterInterface::class,
                class_implements($this->getStandardUI()->export()['router'])
            )
        );
    }

    public function getStandardUI(): StandardUIInterface
    {
        return $this->standardUI;
    }

    public function setStandardUI(StandardUIInterface $standardUI): void
    {
        $this->standardUI = $standardUI;
    }

    public function testGetTemplatesAssignedToResponsesReturnsArrayWhoseTopLevelIndexesAreNumericStrings()
    {
        foreach ($this->getStandardUI()->getTemplatesAssignedToResponses() as $index => $responseTemplates) {
            $this->assertTrue(is_numeric($index));
        }
    }

    public function testGetTemplatesAssignedToResponsesReturnsArrayWhoseSecondLevelIndexesAreNumericStrings()
    {
        foreach ($this->getStandardUI()->getTemplatesAssignedToResponses() as $responseTemplates) {
            foreach ($responseTemplates as $index => $template) {
                $this->assertTrue(is_numeric($index));
            }
        }
    }

    public function testGetTemplatesAssignedToResponsesReturnsMultiDimensionalArrayOfArrays()
    {
        foreach ($this->getStandardUI()->getTemplatesAssignedToResponses() as $index => $responseTemplates) {
            $this->assertTrue(is_array($responseTemplates));
        }
    }

    public function testGetTemplatesAssignedToResponsesReturnsMultiDimensionalArrayOfArraysOfStandardUITemplates(): void
    {
        foreach ($this->getStandardUI()->getTemplatesAssignedToResponses() as $responseTemplates) {
            foreach ($responseTemplates as $template) {
                $this->assertTrue(in_array('DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate', class_implements($template)));
            }
        }
    }

    public function testGetTemplatesAssignedToResponsesReturnsArrayOfAllStandardUITemplatesAssignedToAllResponsesToCurrentRequest(): void
    {
        $this->assertEquals(
            $this->getTemplatesForCurrentRequest(),
            $this->getStandardUI()->getTemplatesAssignedToResponses()
        );
    }

    private function getTemplatesForCurrentRequest(): array
    {
        $templates = [];
        foreach ($this->getResponsesToCurrentRequest() as $response) {
            while (isset($templates[strval($response->getPosition())]) === true) {
                $response->increasePosition();
            }
            foreach ($response->getTemplateStorageInfo() as $storable) {
                $template = $this->getRouter()->getCrud()->read($storable);
                while (isset($templates[strval($response->getPosition())][strval($template->getPosition())]) === true) {
                    $template->increasePosition();
                }
                $templates[strval($response->getPosition())][strval($template->getPosition())] = $template;
            }
        }
        return $templates;
    }

    private function getResponsesToCurrentRequest(): array
    {
        $responses = [];
        foreach ($this->getRouter()->getResponses($this->getComponentLocation(), $this->getResponseContainer()) as $response) {
            array_push($responses, $response);
        }
        return $responses;
    }

    public function testGetOutputComponentsAssignedToResponsesReturnsArrayOfOutputComponents()
    {
        foreach ($this->getStandardUI()->getOutputComponentsAssignedToResponses() as $responseOutputComponents) {
            foreach ($responseOutputComponents as $outputComponentTypes) {
                foreach ($outputComponentTypes as $outputComponent) {
                    $this->assertTrue(
                        in_array(
                            'DarlingDataManagementSystem\interfaces\component\OutputComponent',
                            class_implements($outputComponent)
                        )
                    );
                }
            }
        }
    }

    public function testGetOutputComponentsAssignedToResponsesReturnsArrayWhoseSecondLevelIndexesAreValidOutputComponentTypes()
    {
        foreach ($this->getStandardUI()->getOutputComponentsAssignedToResponses() as $responseOutputComponents) {
            foreach ($responseOutputComponents as $outputComponentType => $outputComponents) {
                $this->assertTrue(
                    in_array(
                        'DarlingDataManagementSystem\interfaces\component\OutputComponent',
                        class_implements($outputComponentType)
                    )
                );
            }
        }
    }

    public function testGetOutputComponentsAssignedToResponsesReturnsArrayWhoseTopLevelIndexesAreNumericStrings()
    {
        foreach ($this->getStandardUI()->getOutputComponentsAssignedToResponses() as $index => $outputComponentTypes) {
            $this->assertTrue(
                is_numeric($index)
            );
        }
    }

    public function testGetOutputComponentsAssignedToResponsesReturnsArrayWhoseThirdLevelIndexesAreNumericStrings()
    {
        foreach ($this->getStandardUI()->getOutputComponentsAssignedToResponses() as $responseOutputComponents) {
            foreach ($responseOutputComponents as $outputComponentTypes) {
                foreach ($outputComponentTypes as $index => $outputComponent) {
                    $this->assertTrue(
                        is_numeric($index)
                    );
                }
            }
        }
    }

    public function testGetOutputComponentsAssignedToResponsesReturnsArrayOfAllOutputComponentsAssignedToAllResponsesToCurrentRequest(): void
    {
        $outputComponents = [];
        foreach ($this->getResponsesToCurrentRequest() as $response) {
            while (isset($outputComponents[strval($response->getPosition())]) === true) {
                $response->increasePosition();
            }
            foreach ($response->getOutputComponentStorageInfo() as $storable) {
                $outputComponent = $this->getRouter()->getCrud()->read($storable);
                while (isset($outputComponents[strval($response->getPosition())][$outputComponent->getType()][strval($outputComponent->getPosition())]) === true) {
                    $outputComponent->increasePosition();
                }
                $outputComponents[strval($response->getPosition())][$outputComponent->getType()][strval($outputComponent->getPosition())] = $outputComponent;
            }
        }
        $this->assertEquals(
            $outputComponents,
            $this->getStandardUI()->getOutputComponentsAssignedToResponses()
        );
    }

    public function testGetOutputReturnsCollectiveOutputFromOutputComponentsOrganizedByResponsePositionThenTemplatePositionThenTemplateOCTypeThenOutputComponentPosition()
    {
        $expectedOutput = '';
        $assignedTemplates = $this->getStandardUI()->getTemplatesAssignedToResponses();
        ksort($assignedTemplates, SORT_NUMERIC);
        foreach ($assignedTemplates as $responsePosition => $responseTemplates) {
            ksort($responseTemplates);
            foreach ($responseTemplates as $template) {
                foreach ($template->getTypes() as $type) {
                    $outputComponents = $this->getStandardUI()->getOutputComponentsAssignedToResponses()[$responsePosition][$type];
                    ksort($outputComponents, SORT_NUMERIC);
                    foreach ($outputComponents as $outputComponent) {
                        $expectedOutput .= $outputComponent->getOutput();
                    }
                }
            }

        }
        $this->assertEquals($expectedOutput, $this->getStandardUI()->getOutput());
    }

    protected function generateStoredTestComponents()
    {
        // @devNote: The generateStoredOutputComponent() and generateStandardUITemplate() methods are call from with generateStoredResponse()
        $this->generateComponentCalls++;
        $this->generateStoredResponse();
        // this is helpful when debugging: $this->devNumberOfStoredComponents();
        //  this is helpful when debugging: $this->devNumberOfGenerateCalls();
    }

    protected function generateStoredResponse(): ResponseInterface
    {
        $response = new CoreResponse(
            new CoreStorable('StandardUITestResponse' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getResponseContainer()
            ),
            new CoreSwitchable()
        );
        for ($incrementer = 0; $incrementer < rand(1, 10); $incrementer++) {
            $response->addOutputComponentStorageInfo($this->generateStoredOutputComponent());
        }
        for ($incrementer = 0; $incrementer < rand(4, 10); $incrementer++) {
            $response->addTemplateStorageInfo($this->generateStoredStandardUITemplateForOutputComponents(rand(0, 3)));
        }
        for ($incrementer = 0; $incrementer < rand(1, 10); $incrementer++) {
            $response->addOutputComponentStorageInfo($this->generateStoredAction());
        }
        for ($incrementer = 0; $incrementer < rand(4, 10); $incrementer++) {
            $response->addTemplateStorageInfo($this->generateStoredStandardUITemplateForActions(rand(0, 3)));
        }
        $response->addRequestStorageInfo($this->getCurrentRequest());
        $this->getRouter()->getCrud()->create($response);
        return $response;
    }

    private function generateStoredOutputComponent(bool $saveToStorage = true): OutputComponentInterface
    {
        $outputComponent = new CoreOutputComponent(
            new CoreStorable(
                'StandardUITestOutputComponent' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getOutputComponentContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable(rand(0, 99))
        );
        $outputComponent->import(['output' => 'Some plain text' . strval(rand(10000, 99999))]);
        if ($saveToStorage === true) {
            $this->getRouter()->getCrud()->create($outputComponent);
        }
        return $outputComponent;
    }

    private function generateStoredStandardUITemplateForOutputComponents(float $position = 0): StandardUITemplateInterface
    {
        $standardUITemplate = new CoreStandardUITemplate(
            new CoreStorable(
                'StandardUITestTemplate' . strval(rand(10, 99)),
                $this->getComponentLocation(),
                $this->getStandardUITemplateContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable($position)
        );
        $standardUITemplate->addType($this->generateStoredOutputComponent(false));
        $this->getRouter()->getCrud()->create($standardUITemplate);
        return $standardUITemplate;
    }

    private function generateStoredAction(bool $saveToStorage = true): ActionInterface
    {
        $action = new CoreAction(
            new CoreStorable(
                'StandardUITestAction' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getOutputComponentContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable(rand(0, 99))
        );
        $action->import(['output' => 'Some plain text' . strval(rand(10000, 99999))]);
        if ($saveToStorage === true) {
            $this->getRouter()->getCrud()->create($action);
        }
        return $action;
    }

    private function generateStoredStandardUITemplateForActions(float $position = 0): CoreStandardUITemplate
    {
        $standardUITemplate = new CoreStandardUITemplate(
            new CoreStorable(
                'StandardUITestTemplate' . strval(rand(10, 99)),
                $this->getComponentLocation(),
                $this->getStandardUITemplateContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable($position)
        );
        $standardUITemplate->addType($this->generateStoredAction(false));
        $this->getRouter()->getCrud()->create($standardUITemplate);
        return $standardUITemplate;
    }

    protected function setStandardUIParentTestInstances(): void
    {
        $this->setOutputComponent($this->getStandardUI());
        $this->setOutputComponentParentTestInstances();
    }

    /**
     * DONT REMOVE THIS METHOD | IT IS USEFUL FOR DEBUGGING
     * @noinspection PhpUnusedPrivateMethodInspection
     */
    private function devNumberOfStoredComponents(): void
    {
        var_dump(
            'Number of Stored Responses: ' . strval($this->countNumberOfStoredComponentsInContainer($this->getResponseContainer())),
            'Number of Stored Templates: ' . strval($this->countNumberOfStoredComponentsInContainer($this->getStandardUITemplateContainer())),
            'Number of Stored OutputComponents: ' . strval($this->countNumberOfStoredComponentsInContainer($this->getOutputComponentContainer())),
            'Number of Stored Requests: ' . strval($this->countNumberOfStoredComponentsInContainer($this->getRequestContainer()))
        );
    }

    private function countNumberOfStoredComponentsInContainer(string $container): int
    {
        return count($this->getRouter()->getCrud()->readAll($this->getComponentLocation(), $container));
    }

    /**
     * DONT REMOVE THIS METHOD | IT IS USEFUL FOR DEBUGGING
     * @noinspection PhpUnusedPrivateMethodInspection
     */
    private function devNumberOfGenerateCalls(): void
    {
        var_dump(
            'Number of generate calls per test: ' . strval($this->generateComponentCalls)
        );
    }

    /**
     * DONT REMOVE THIS METHOD | IT IS USEFUL FOR DEBUGGING
     * @noinspection PhpUnusedPrivateMethodInspection
     * @param string $type Use  Component->getType()
     * @param string $container use one of the $this->>get*Container() methods
     */
    private function devStoredComponentInfo(string $type, string $container): void
    {
        var_dump(
            [
                '# Stored ' . $type . 's' => count(
                    $this->getStoredComponents($container)
                )
            ]
        );
        $this->getStoredComponentStorableInfo($container);
    }

    private function getStoredComponentStorableInfo(string $container): void
    {
        foreach ($this->getStoredComponents($container) as $storedComponent) {
            var_dump(
                [
                    'name' => $storedComponent->getName(),
                    'uniqueId' => $storedComponent->getUniqueId(),
                    'location' => $storedComponent->getLocation(),
                    'container' => $storedComponent->getContainer(),
                    'type' => $storedComponent->getType()
                ]
            );
        }
    }

    protected function getTestInstanceArgs(): array {
        return [
            new CoreStorable(
                'StandardUIName',
                $this->getComponentLocation(),
                $this->getStandardUIContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable(),
            $this->getRouter(),
        ];
    }
}
