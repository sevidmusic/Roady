<?php

namespace DarlingDataManagementSystem\abstractions\component\UserInterface;

use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\component\UserInterface\ResponseUI as ResponseUIInterface;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use RuntimeException as PHPRuntimeException;

abstract class ResponseUI extends CoreOutputComponent implements ResponseUIInterface
{

    private RouterInterface $router;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable, RouterInterface $router)
    {
        parent::__construct($storable, $switchable, $positionable);
        $this->router = $router;
    }

    private function sortPositionables(PositionableInterface ...$postionables): array
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


    private function getRoutersComponentCrud(): ComponentCrudInterface
    {
        return $this->router->export()['crud'];
    }

    private function buildOutput(): string
    {
        $expectedOutput = '';
        $expectedResponses = $this->router->getResponses(
            CoreApp::deriveNameLocationFromRequest($this->router->getRequest()),
            ResponseInterface::RESPONSE_CONTAINER
        );
        $sortedResponses = $this->sortPositionables(...$expectedResponses);;
        foreach($sortedResponses as $response)
        {
            $outputComponents = [];
            foreach($response->getOutputComponentStorageInfo() as $storable)
            {
                $component = $this->getRoutersComponentCrud()->read($storable);
                $classImplements = class_implements($component);
                $isAnOutputComponent = (is_array($classImplements) ? in_array(OutputComponentInterface::class, $classImplements) : false);
                if($isAnOutputComponent === true)
                {
                    array_push($outputComponents, $component);
                }
            }
            $sortedOutputComponents = $this->sortPositionables(...$outputComponents);
            foreach($sortedOutputComponents as $outputComponent)
            {
                $expectedOutput .= $outputComponent->getOutput();
            }
        }
        if(empty($expectedOutput))
        {
            throw new PHPRuntimeException('There is nothing to show for this request.');
        }
        return $expectedOutput;
    }

    public function getOutput(): string
    {
        $this->import(['output' => $this->buildOutput()]);
        return parent::getOutput();
    }
}
