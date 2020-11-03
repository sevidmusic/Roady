<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingDataManagementSystem\interfaces\component\UserInterface\ResponseUI;

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

}