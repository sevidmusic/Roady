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

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, Router $router)
    {
        parent::__construct($storable, $switchable, $positionable);
        // @todo define testRouterIsSetOnInstantiation()
        $this->router = $router;
    }

    public function getTemplatesAssignedToResponses(string $location, string $container): array
    {
       /**
        * //NOTE: Rename $location and $container to $responseLocation $responseContainer to be more clear
        */
        $templates = [];
        foreach ($this->router->getResponses($location, $container) as $response) {
            foreach ($response->getTemplateStorageInfo() as $templateStorable) {
            $template = $this->router->getCrud()->read($templateStorable);
            if (isset($templates[$template->getPosition()]) === true) {
                $template->increasePosition();
            }
            $templates[strval($template->getPosition())] = $template;
            }
        }
        return $templates;
    }

    public function getOutputComponentsAssignedToResponses(string $location, string $container): array
    {
       /**
        * //NOTE: Rename $location and $container to $responseLocation $responseContainer to be more clear
        */
        $outputComponents = [];
        foreach ($this->router->getResponses($location, $container) as $response) {
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
        return $outputComponents;
    }

}
