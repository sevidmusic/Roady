<?php

namespace UnitTests\interfaces\component\DS_COMPONENT_SUBTYPE\TestTraits;

use DarlingCms\interfaces\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME;

trait DS_COMPONENT_NAMETestTrait
{

    private $DS_COMPONENT_NAME;

    protected function setDS_COMPONENT_NAMEParentTestInstances(): void
    {
        $this->setComponent($this->getDS_COMPONENT_NAME());
        $this->setComponentParentTestInstances();
    }

    public function getDS_COMPONENT_NAME(): DS_COMPONENT_NAME
    {
        return $this->DS_COMPONENT_NAME;
    }

    public function setDS_COMPONENT_NAME(DS_COMPONENT_NAME $DS_COMPONENT_NAME)
    {
        $this->DS_COMPONENT_NAME = $DS_COMPONENT_NAME;
    }

}
