<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingCms\classes\component\Crud\ComponentCrud;
use DarlingCms\classes\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\classes\component\OutputComponent;
use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingCms\interfaces\component\UserInterface\StandardUI;

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
        $this->router = new Router(
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
            //var_dump($this->currentRequest->getUrl());
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

    public function testRouterIsSetPostInstantiation(): void
    {
        $this->assertEquals
        ("DarlingCms\classes\component\Web\Routing\Router",
            $this->getStandardUI()->export()['router']->getType()
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

    public function testGetTemplatesAssignedToResponsesReturnsArrayOfStandardUITemplates(): void
    {
        foreach (
            $this->getStandardUI()->getTemplatesAssignedToResponses() as $template) {
            $this->assertTrue(in_array('DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate', class_implements($template)));
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
            foreach ($response->getTemplateStorageInfo() as $storable) {
                $template = $this->getStandardUITestRouter()->getCrud()->read($storable);
                while (isset($templates[strval($template->getPosition())]) === true) {
                    $template->increasePosition();
                }
                $templates[strval($template->getPosition())] = $template;
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
        foreach (
            $this->getStandardUI()->getOutputComponentsAssignedToResponses() as $outputComponentTypes) {
            foreach ($outputComponentTypes as $outputComponent) {
                $this->assertTrue(
                    in_array(
                        'DarlingCms\interfaces\component\OutputComponent',
                        class_implements($outputComponent)
                    )
                );

            }
        }
    }

    public function testGetOutputComponentsAssignedToResponsesReturnsArrayWhoseTopLevelIndexesAreValidOutputComponentTypes()
    {
        foreach (
            $this->getStandardUI()->getOutputComponentsAssignedToResponses() as $outputComponentType => $outputComponents) {
            $this->assertTrue(
                in_array(
                    'DarlingCms\interfaces\component\OutputComponent',
                    class_implements($outputComponentType)
                )
            );
        }
    }

    public function testGetOutputComponentsAssignedToResponsesReturnsArrayWhoseSecondLevelIndexesAreNumericStrings()
    {
        foreach (
            $this->getStandardUI()->getOutputComponentsAssignedToResponses() as $outputComponentTypes) {
            foreach ($outputComponentTypes as $index => $outputComponent) {
                $this->assertTrue(
                    is_numeric($index)
                );

            }
        }
    }

    public function testGetOutputComponentsAssignedToResponsesReturnsArrayOfAllOutputComponentsAssignedToAllResponsesToCurrentRequest(): void
    {
        $outputComponents = [];
        foreach ($this->getResponsesToCurrentRequest() as $response) {
            foreach ($response->getOutputComponentStorageInfo() as $storable) {
                $outputComponent = $this->getStandardUITestRouter()->getCrud()->read($storable);
                while (isset($outputComponents[$outputComponent->getType()][strval($outputComponent->getPosition())]) === true) {
                    $outputComponent->increasePosition();
                }
                $outputComponents[$outputComponent->getType()][strval($outputComponent->getPosition())] = $outputComponent;
            }
        }
        $this->assertEquals(
            $outputComponents,
            $this->getStandardUI()->getOutputComponentsAssignedToResponses()
        );
    }

    public function testGetTemplatesAssignedToResponsesReturnsArrayWhoseIndexesAreNumericStrings()
    {
        foreach (
            $this->getStandardUI()->getTemplatesAssignedToResponses() as $index => $templates) {
            $this->assertTrue(is_numeric($index));
        }
    }

    public function testGetOutputReturnsCollectiveOutputFromOutputComponentsOrganizedByTemplateThenOutputComponentPosition()
    {
        $expectedOutput = '';
        foreach ($this->getStandardUI()->getTemplatesAssignedToResponses() as $template) {
            foreach ($template->getTypes() as $type) {
                foreach ($this->getStandardUI()->getOutputComponentsAssignedToResponses()[$type] as $outputComponent) {
                    $expectedOutput .= $outputComponent->getOutput();
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
        for ($i = 0; $i < 4; $i++) {
            $response->addOutputComponentStorageInfo($this->generateStoredOutputComponent());
        }
        for ($i = 0; $i < 3; $i++) {
            $response->addTemplateStorageInfo($this->generateStoredStandardUITemplate());
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
            new Positionable(0)
        );
        $outputComponent->import(['output' => 'Some plain text' . strval(rand(10000, 99999))]);
        if ($saveToStorage === true) {
            $this->getStandardUITestRouter()->getCrud()->create($outputComponent);
        }
        return $outputComponent;
    }

    private function generateStoredStandardUITemplate(): StandardUITemplate
    {
        $standardUITemplate = new StandardUITemplate(
            new Storable(
                'StandardUITestTemplate' . strval(rand(10, 99)),
                $this->getComponentLocation(),
                $this->getStandardUITemplateContainer()
            ),
            new Switchable(),
            new Positionable(0) // !IMPORTANT: We want all Positionable components to be assigned a 0 position to start so we know that positions are increased properly  | @todo need tests for this, i.e., testGet*AssignedToResponsesIncreasesComponentPositionIfPositionOccupied(): void
        );
        $standardUITemplate->addType($this->generateStoredOutputComponent(false));
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
