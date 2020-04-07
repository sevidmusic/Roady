<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingCms\interfaces\component\Action;

trait ActionTestTrait
{

    private $action;

    protected function setActionParentTestInstances(): void
    {
        $this->setOutputComponent($this->getAction());
        $this->setOutputComponentParentTestInstances();
    }

    public function getAction(): Action
    {
        return $this->action;
    }

    public function setAction(Action $action): void
    {
        $this->action = $action;
    }

}
