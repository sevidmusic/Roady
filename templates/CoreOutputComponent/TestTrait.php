<?php

namespace DS_TESTS_NAMESPACE_PREFIX\interfaces\component\DS_COMPONENT_SUBTYPE\TestTraits;

use DS_CORE_NAMESPACE_PREFIX\interfaces\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME;

trait DS_COMPONENT_NAMETestTrait
{

    private $DS_COMPONENT_NAME;

    protected function setDS_COMPONENT_NAMEParentTestInstances(): void
    {
        $this->setOutputComponent($this->getDS_COMPONENT_NAME());
        $this->setOutputComponentParentTestInstances();
    }

    public function getDS_COMPONENT_NAME(): DS_COMPONENT_NAME
    {
        return $this->DS_COMPONENT_NAME;
    }

    public function setDS_COMPONENT_NAME(DS_COMPONENT_NAME $DS_COMPONENT_NAME): void
    {
        $this->DS_COMPONENT_NAME = $DS_COMPONENT_NAME;
    }

}
