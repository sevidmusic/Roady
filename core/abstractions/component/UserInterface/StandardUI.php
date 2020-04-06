<?php

namespace DarlingCms\abstractions\component\UserInterface;

use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\interfaces\component\UserInterface\StandardUI as StandardUIInterface;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class StandardUI extends CoreOutputComponent implements StandardUIInterface
{

    private $router;
    private $templates = [];
    private $outputComponents = [];
    private $responseLocation = '';
    private $responseContainer = '';

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, Router $router, string $responseLocation, string $responseContainer)
    {
        parent::__construct($storable, $switchable, $positionable);
        // @todo define testRouterIsSetOnInstantiation()
        $this->router = $router;
        $this->responseLocation = $responseLocation;
        $this->responseContainer = $responseContainer;
    }

    public function getTemplatesAssignedToResponses(): array
    {
        /**
         * //NOTE: Rename $location and $container to $responseLocation $responseContainer to be more clear
         */
        if (empty($this->templates) === true) {
            $templates = [];
            foreach ($this->router->getResponses($this->responseLocation, $this->responseContainer) as $response) {
                foreach ($response->getTemplateStorageInfo() as $templateStorable) {
                    $template = $this->router->getCrud()->read($templateStorable);
                    if (isset($templates[$template->getPosition()]) === true) {
                        $template->increasePosition();
                    }
                    $templates[strval($template->getPosition())] = $template;
                }
            }
            $this->templates = $templates;
        } //
        return $this->templates;
    }

    public function getOutputComponentsAssignedToResponses(): array
    {
        /**
         * //NOTE: Rename $location and $container to $responseLocation $responseContainer to be more clear
         */
        if (empty($this->outputComponents) === true) {
            $outputComponents = [];
            foreach ($this->router->getResponses($this->responseLocation, $this->responseContainer) as $response) {
                foreach ($response->getOutputComponentStorageInfo() as $outputComponentStorable) {
                    $outputComponent = $this->router->getCrud()->read($outputComponentStorable);
                    if (isset($outputComponents[$outputComponent->getType()][strval($outputComponent->getPosition())]) === true) {
                        /** @noinspection PhpUndefinedFunctionInspection */
                        /** @noinspection PhpExpressionResultUnusedInspection */
                        $outputComponent > increasePosition();
                    }
                    $outputComponents[$outputComponent->getType()][strval($outputComponent->getPosition())] = $outputComponent;
                }
            }
            $this->outputComponents = $outputComponents;
        }
        return $this->outputComponents;
    }

    public function getOutput(): string
    {
        $output = '';
        foreach($this->getTemplatesAssignedToResponses() as $template)
        {
            foreach($template->getTypes() as $type) {
                foreach($this->getOutputComponentsAssignedToResponses() as $outputComponentTypes)
                {
                    foreach($outputComponentTypes as $outputComponent)
                    {
                        $output .= $outputComponent->getOutput();
                    }
                }
            }
        }
        $this->import(['output' => $output]);
        return parent::getOutput();
    }

}
