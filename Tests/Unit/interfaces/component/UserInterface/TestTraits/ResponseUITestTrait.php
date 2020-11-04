<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingDataManagementSystem\interfaces\component\UserInterface\ResponseUI;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
use DarlingDataManagementSystem\classes\primary\Positionable;

trait ResponseUITestTrait
{

    private $responseUI;

    protected function setResponseUIParentTestInstances(): void
    {
        $this->setOutputComponent($this->getResponseUI());
        $this->setOutputComponentParentTestInstances();
    }

    public function getResponseUI(): ResponseUI
    {
        return $this->responseUI;
    }

    public function setResponseUI(ResponseUI $responseUI): void
    {
        $this->responseUI = $responseUI;
    }

    public function getResponseUITestArgs(): array
    {
        return [
            new Storable(
                'MockResponseUIName',
                'MockResponseUILocation',
                'MockResponseUIContainer'
            ),
            new Switchable(),
            new Positionable()
        ];
    }
}
