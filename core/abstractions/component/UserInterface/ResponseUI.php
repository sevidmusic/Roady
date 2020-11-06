<?php

namespace DarlingDataManagementSystem\abstractions\component\UserInterface;

use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\component\UserInterface\ResponseUI as ResponseUIInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;

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
        return $sorted;
    }


    public function getOutput(): string
    {
        return '';
    }

}
