<?php

namespace UnitTests\interfaces\primary\TestTraits;

use DarlingCms\interfaces\primary\DS_COMPONENT_NAME;

trait DS_COMPONENT_NAMETestTrait
{

    private $DS_COMPONENT_NAME;

    protected function getDS_COMPONENT_NAME(): DS_COMPONENT_NAME
    {
        return $this->DS_COMPONENT_NAME;
    }

    protected function setDS_COMPONENT_NAME(DS_COMPONENT_NAME $DS_COMPONENT_NAME): void
    {
        $this->DS_COMPONENT_NAME = $DS_COMPONENT_NAME;
    }

}
