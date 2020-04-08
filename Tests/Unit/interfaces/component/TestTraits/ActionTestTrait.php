<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingCms\interfaces\component\Action;

trait ActionTestTrait
{

    private $action;

    public function testIsDoneReturnsTrueAfterCallToDo(): void
    {
        $this->getAction()->do();
        $this->assertTrue($this->getAction()->isDone());
    }

    public function testWasUndoneReturnsTrueAfterCallToUndo(): void
    {
        $this->getAction()->undo();
        $this->assertTrue($this->getAction()->wasUndone());
    }

    public function testDoReturnsTrue(): void
    {
        $this->assertTrue($this->getAction()->do());
    }

    public function testUndoReturnsTrue(): void
    {
        $this->assertTrue($this->getAction()->undo());
    }

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
