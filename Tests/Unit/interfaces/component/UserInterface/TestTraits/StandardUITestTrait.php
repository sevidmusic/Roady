<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingDataManagementSystem\classes\component\Action;
use DarlingDataManagementSystem\classes\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\classes\component\Driver\Storage\StandardStorageDriver as StorageDriver;
use DarlingDataManagementSystem\classes\component\OutputComponent;
use DarlingDataManagementSystem\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request;
use DarlingDataManagementSystem\classes\component\Web\Routing\Response;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router;
use DarlingDataManagementSystem\classes\component\Web\Routing\Router as CoreRouter;
use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\UserInterface\StandardUI;

trait StandardUITestTrait
{

    private $standardUI;
    private $router;
    private $currentRequest;
    private $generateComponentCalls = 0;

    public function getStandardUIContainer(): string
    {
        return 'StandardUITestStandardUIContainer';
    }

    public function tearDown(): void
    {
        // @todo : Working on fixing this...
        foreach ($this->getStoredComponents($this->getComponentLocation(), $this->getOutputComponentContainer()) as $storedComponent) {
            $this->getStandardUITestRouter()->getCrud()->delete($storedComponent);
        }
        foreach ($this->getStoredComponents($this->getComponentLocation(), $this->getStandardUITemplateContainer()) as $storedComponent) {
            $this->getStandardUITestRouter()->getCrud()->delete($storedComponent);
        }
        foreach ($this->getStoredComponents($this->getComponentLocation(), $this->getResponseContainer()) as $storedComponent) {
            $this->getStandardUITestRouter()->getCrud()->delete($storedComponent);
        }
        foreach ($this->getStoredComponents($this->getComponentLocation(), $this->getRequestContainer()) as $storedComponent) {
            $this->getStandardUITestRouter()->getCrud()->delete($storedComponent);
        }
    }

    protected function getStoredComponents(string $location, string $container): array
    {
        return $this->getStandardUITestRouter()->getCrud()->readAll(
            $location,
            $container
        );
    }

    public function getStandardUITestRouter(): Router
    {
        if (isset($this->router)) {
            return $this->router;
        }
        $this->router = new CoreRouter(
            new Storable(
                'StandardUITestRouter' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getRouterContainer()
            ),
            new Switchable(),
            $this->getCurrentRequest(),
            $this->getComponentCrudForRouter()
        );
        return $this->router;
    }

    public function getComponentLocation(): string
    {
        return 'StandardUITestComponentsLocation';
    }

    public function getRouterContainer(): string
    {
        return "StandardUITestRouterContainer";
    }

    public function getCurrentRequest(): Request
    {
        if (isset($this->currentRequest) === true) {
            return $this->currentRequest;
        }
        $this->currentRequest = new Request(
            new Storable(
                'StandardUICurrentRequest' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getRequestContainer()
            ),
            new Switchable()
        );
        $this->getStandardUITestRouter()->getCrud()->create($this->currentRequest);
        return $this->currentRequest;
    }

    public function getRequestContainer(): string
    {
        return "StandardUITestRequestContainer";
    }

    private function getComponentCrudForRouter(): ComponentCrudInterface
    {
        if (isset($this->router) === true) {
            return $this->getStandardUITestRouter()->getCrud();
        }
        return new ComponentCrud(
            new Storable(
                'StandardUITestComponentCrudForStandardUITestRouter' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getComponentCrudContainer()
            ),
            new Switchable(),
            new StorageDriver(
                new Storable(
                    'StandardUITestStorageDriver' . strval(rand(0, 999)),
                    $this->getComponentLocation(),
                    $this->getStorageDriverContainer()
                ),
                new Switchable()
            )
        );
    }

    public function getComponentCrudContainer(): string
    {
        return "StandardUITestComponentCruds";
    }

    public function getStorageDriverContainer(): string
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
        return Response::RESPONSE_CONTAINER;
    }

    public function testRouterPropertyIsAssignedARouterImplementationInstancePostInstantiation(): void
    {
        $this->assertTrue(
            in_array(
                Router::class,
                class_implements($this->getStandardUI()->export()['router'])
            )
        );
    }

    public function getStandardUI(): StandardUI
    {
        return $this->standardUI;
    }

    public function setStandardUI(StandardUI $standardUI): void
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
                $template = $this->getStandardUITestRouter()->getCrud()->read($storable);
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
        foreach ($this->getStandardUITestRouter()->getResponses($this->getComponentLocation(), $this->getResponseContainer()) as $response) {
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
                $outputComponent = $this->getStandardUITestRouter()->getCrud()->read($storable);
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

    protected function generateStoredResponse(): Response
    {
        $response = new Response(
            new Storable('StandardUITestResponse' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getResponseContainer()
            ),
            new Switchable()
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
        $this->getStandardUITestRouter()->getCrud()->create($response);
        return $response;
    }

    private function generateStoredOutputComponent(bool $saveToStorage = true): OutputComponent
    {
        $outputComponent = new OutputComponent(
            new Storable(
                'StandardUITestOutputComponent' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getOutputComponentContainer()
            ),
            new Switchable(),
            new Positionable(rand(0, 99))
        );
        $outputComponent->import(['output' => 'Some plain text' . strval(rand(10000, 99999))]);
        if ($saveToStorage === true) {
            $this->getStandardUITestRouter()->getCrud()->create($outputComponent);
        }
        return $outputComponent;
    }

    private function generateStoredStandardUITemplateForOutputComponents(float $position = 0): StandardUITemplate
    {
        $standardUITemplate = new StandardUITemplate(
            new Storable(
                'StandardUITestTemplate' . strval(rand(10, 99)),
                $this->getComponentLocation(),
                $this->getStandardUITemplateContainer()
            ),
            new Switchable(),
            new Positionable($position)
        );
        $standardUITemplate->addType($this->generateStoredOutputComponent(false));
        $this->getStandardUITestRouter()->getCrud()->create($standardUITemplate);
        return $standardUITemplate;
    }

    private function generateStoredAction(bool $saveToStorage = true): Action
    {
        $action = new Action(
            new Storable(
                'StandardUITestAction' . strval(rand(0, 999)),
                $this->getComponentLocation(),
                $this->getOutputComponentContainer()
            ),
            new Switchable(),
            new Positionable(rand(0, 99))
        );
        $action->import(['output' => 'Some plain text' . strval(rand(10000, 99999))]);
        if ($saveToStorage === true) {
            $this->getStandardUITestRouter()->getCrud()->create($action);
        }
        return $action;
    }

    private function generateStoredStandardUITemplateForActions(float $position = 0): StandardUITemplate
    {
        $standardUITemplate = new StandardUITemplate(
            new Storable(
                'StandardUITestTemplate' . strval(rand(10, 99)),
                $this->getComponentLocation(),
                $this->getStandardUITemplateContainer()
            ),
            new Switchable(),
            new Positionable($position)
        );
        $standardUITemplate->addType($this->generateStoredAction(false));
        $this->getStandardUITestRouter()->getCrud()->create($standardUITemplate);
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
        return count($this->getStandardUITestRouter()->getCrud()->readAll($this->getComponentLocation(), $container));
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
                    $this->getStoredComponents(
                        $this->getComponentLocation(),
                        $container
                    )
                )
            ]
        );
        $this->getStoredComponentStorableInfo($container);
    }

    private function getStoredComponentStorableInfo(string $container): void
    {
        foreach ($this->getStoredComponents($this->getComponentLocation(), $container) as $storedComponent) {
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
}
