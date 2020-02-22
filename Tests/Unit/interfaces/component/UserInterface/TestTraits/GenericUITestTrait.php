<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingCms\interfaces\component\UserInterface\GenericUI;

trait GenericUITestTrait
{

    private $genericUI;

    protected function setGenericUIParentTestInstances(): void
    {
        $this->setOutputComponent($this->getGenericUI());
        $this->setOutputComponentParentTestInstances();
    }

    public function getGenericUI(): GenericUI
    {
        return $this->genericUI;
    }

    public function setGenericUI(GenericUI $genericUI): void
    {
        $this->genericUI = $genericUI;
    }

}
