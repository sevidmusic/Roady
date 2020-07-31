<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace DarlingDataManagementSystem\abstractions\component\UserInterface;

use DarlingDataManagementSystem\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\classes\component\Web\Routing\Router;
use DarlingDataManagementSystem\interfaces\component\UserInterface\StandardUI as StandardUIInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class StandardUI extends CoreOutputComponent implements StandardUIInterface
{

    private $router;
    private $templates = [];
    private $outputComponents = [];
    private $responseLocation;
    private $responseContainer;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, Router $router, string $responseLocation, string $responseContainer)
    {
        parent::__construct($storable, $switchable, $positionable);
        $this->router = $router;
        $this->responseLocation = $responseLocation;
        $this->responseContainer = $responseContainer;
    }

    public function getOutput(): string
    {
        $output = '';
        $assignedTemplates = $this->getTemplatesAssignedToResponses();
        ksort($assignedTemplates, SORT_NUMERIC);
        foreach ($assignedTemplates as $responsePosition => $responseTemplates) {
            ksort($responseTemplates);
            foreach ($responseTemplates as $template) {
                foreach ($template->getTypes() as $type) {
                    foreach ($this->getOutputComponentsAssignedToResponses()[$responsePosition][$type] as $outputComponent) {
                        $output .= $outputComponent->getOutput();

                    }
                }
            }

        }
        $this->import(['output' => $output]);
        return parent::getOutput();
    }

    public function getTemplatesAssignedToResponses(): array
    {
        if (empty($this->templates) === true) {
            $templates = [];
            foreach ($this->router->getResponses($this->responseLocation, $this->responseContainer) as $response) {
                while (isset($templates[strval($response->getPosition())]) === true) {
                    $response->increasePosition();
                }
                foreach ($response->getTemplateStorageInfo() as $templateStorable) {
                    $template = $this->router->getCrud()->read($templateStorable);
                    while (isset($templates[strval($response->getPosition())][strval($template->getPosition())]) === true) {
                        $template->increasePosition();
                    }
                    $templates[strval($response->getPosition())][strval($template->getPosition())] = $template;
                }
            }
            $this->templates = $templates;
        }
        return $this->templates;
    }

    public function getOutputComponentsAssignedToResponses(): array
    {
        if (empty($this->outputComponents) === true) {
            $outputComponents = [];
            foreach ($this->router->getResponses($this->responseLocation, $this->responseContainer) as $response) {
                while (isset($outputComponents[strval($response->getPosition())]) === true) {
                    $response->increasePosition();
                }
                foreach ($response->getOutputComponentStorageInfo() as $outputComponentStorable) {
                    $outputComponent = $this->router->getCrud()->read($outputComponentStorable);
                    while (isset($outputComponents[strval($response->getPosition())][$outputComponent->getType()][strval($outputComponent->getPosition())]) === true) {
                        $outputComponent->increasePosition();
                    }
                    $outputComponents[strval($response->getPosition())][$outputComponent->getType()][strval($outputComponent->getPosition())] = $outputComponent;
                    ksort($outputComponents[strval($response->getPosition())][$outputComponent->getType()]);
                }
            }
            $this->outputComponents = $outputComponents;
        }
        return $this->outputComponents;
    }

}
