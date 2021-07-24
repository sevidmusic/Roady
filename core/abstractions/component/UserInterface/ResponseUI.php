<?php

namespace roady\abstractions\component\UserInterface;

use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\abstractions\component\OutputComponent as CoreOutputComponent;
use roady\interfaces\component\UserInterface\ResponseUI as ResponseUIInterface;
use roady\classes\component\Web\App as CoreApp;
use roady\interfaces\component\Web\Routing\Router as RouterInterface;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use RuntimeException as PHPRuntimeException;

abstract class ResponseUI extends CoreOutputComponent implements ResponseUIInterface
{

    protected RouterInterface $router;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable, RouterInterface $router)
    {
        parent::__construct($storable, $switchable, $positionable);
        $this->router = $router;
    }

    /**
     * @return array<string, PositionableInterface>
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
        /** @var array<string, PositionableInterface> $sorted */
        return $sorted;
    }


    protected function getRoutersComponentCrud(): ComponentCrudInterface
    {
        return $this->router->export()['crud'];
    }

    private function buildOutput(): string
    {
        $expectedOutput = '';
        $expectedResponses = $this->router->getResponses(
            CoreApp::deriveAppLocationFromRequest($this->router->getRequest()),
            ResponseInterface::RESPONSE_CONTAINER
        );
        $sortedResponses = $this->sortPositionables(...$expectedResponses);;
        /**
         * @var ResponseInterface $response
         */
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
                    /**
                     * @var OutputComponentInterface $component
                     */
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

    public function getRouter(): RouterInterface
    {
        return $this->router;
    }
}
