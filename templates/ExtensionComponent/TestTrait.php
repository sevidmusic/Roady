<?php

namespace Extensions\DS_EXTENSION_NAME\Tests\Unit\interfaces\component\DS_COMPONENT_SUBTYPE\TestTraits;

use Extensions\DS_EXTENSION_NAME\core\interfaces\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME;

// This may be needed, dont use unless it is: use UnitTests\interfaces\component\TestTraits;

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
