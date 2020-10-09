<?php

namespace DarlingDataManagementSystem\abstractions\component\UserInterface;

use DarlingDataManagementSystem\abstractions\component\OutputComponent as OutputComponentBase;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\interfaces\component\UserInterface\StandardUI as StandardUIInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use RuntimeException as PHPRuntimeException;

abstract class StandardUI extends OutputComponentBase implements StandardUIInterface
{

    private RouterInterface $router;
    private array $templates = [];
    private array $outputComponents = [];
    private string $appLocation;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable, RouterInterface $router)
    {
        parent::__construct($storable, $switchable, $positionable);
        $this->router = $router;
        $this->appLocation = CoreApp::deriveNameLocationFromRequest($router->getRequest());
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
        if (empty($output)) {
            throw new PHPRuntimeException('404: Nothing tho show for ' . $this->router->getRequest()->getUrl());
        }
        return parent::getOutput();
    }

    public function getTemplatesAssignedToResponses(): array
    {
        if (empty($this->templates) === true) {
            $templates = [];
            foreach ($this->router->getResponses($this->appLocation, $this->router->getResponseContainer()) as $response) {
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
            foreach ($this->router->getResponses($this->appLocation, $this->router->getResponseContainer()) as $response) {
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
