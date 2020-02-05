<?php

namespace UnitTests\interfaces\component\Crud\TestTraits;

use DarlingCms\interfaces\component\Crud\ComponentCrud;

trait ComponentCrudTestTrait
{

    private $componentCrud;

    protected function setComponentCrudParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getComponentCrud());
        $this->setSwitchableComponentParentTestInstances();
    }

    public function getComponentCrud(): ComponentCrud
    {
        return $this->componentCrud;
    }

    public function setComponentCrud(ComponentCrud $componentCrud): void
    {
        $this->componentCrud = $componentCrud;
    }

}
