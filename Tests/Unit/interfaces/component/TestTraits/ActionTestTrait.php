<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Action;
use DarlingCms\interfaces\component\Web\Routing\Request;

trait ActionTestTrait
{

    private $action;
    private $currentRequest;

    public function testWasDoneReturnsTrueAfterCallToDo(): void
    {
        $this->getAction()->do();
        $this->assertTrue($this->getAction()->wasDone());
    }

    public function getAction(): Action
    {
        return $this->action;
    }

    public function setAction(Action $action): void
    {
        $this->action = $action;
    }

    public function testWasUndoneReturnsTrueAfterCallToUndo(): void
    {
        $this->getAction()->do();
        $this->getAction()->undo();
        $this->assertTrue($this->getAction()->wasUndone());
    }

    public function testDoReturnsTrue(): void
    {
        $this->assertTrue($this->getAction()->do());
    }

    public function testUndoReturnsTrue(): void
    {
        $this->getAction()->do();
        $this->assertTrue($this->getAction()->undo());
    }

    public function testCurrentRequestIsSetPostInstantiation(): void
    {
        $this->assertTrue(
            isset($this->getAction()->export()['currentRequest'])
        );
    }

    public function testUndoReturnsFalseIfCalledBeforeDo(): void
    {
        $this->assertFalse($this->getAction()->undo());
    }

    public function testWasDoneReturnsTrueAfterCallToGetOutput(): void
    {
        $this->getAction()->getOutput();
        $this->assertTrue($this->getAction()->wasDone());
    }

    protected function getCurrentRequest(): Request
    {
        if (isset($this->currentRequest) === false) {
            $currentRequest = new \DarlingCms\classes\component\Web\Routing\Request(
                new Storable(
                    "CurrentRequestForActionTests",
                    'Location',
                    'Container'
                ),
                new Switchable()
            );
            $this->currentRequest = $currentRequest;
        }
        return $this->currentRequest;
    }

    protected function setActionParentTestInstances(): void
    {
        $this->setOutputComponent($this->getAction());
        $this->setOutputComponentParentTestInstances();
    }

}
