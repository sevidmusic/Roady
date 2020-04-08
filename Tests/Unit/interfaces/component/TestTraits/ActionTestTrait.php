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

    public function testIsDoneReturnsTrueAfterCallToDo(): void
    {
        $this->getAction()->do($this->getCurrentRequest());
        $this->assertTrue($this->getAction()->isDone());
    }

    public function getAction(): Action
    {
        return $this->action;
    }

    public function setAction(Action $action): void
    {
        $this->action = $action;
    }

    private function getCurrentRequest(): Request
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

    public function testWasUndoneReturnsTrueAfterCallToUndo(): void
    {
        $this->getAction()->do($this->getCurrentRequest());
        $this->getAction()->undo();
        $this->assertTrue($this->getAction()->wasUndone());
    }

    public function testDoReturnsTrue(): void
    {
        $this->assertTrue($this->getAction()->do($this->getCurrentRequest()));
    }

    public function testUndoReturnsTrue(): void
    {
        $this->getAction()->do($this->getCurrentRequest());
        $this->assertTrue($this->getAction()->undo());
    }

    public function testCurrentRequestPropertyIsSetToCurrentRequestAfterCallToDo(): void
    {
        $this->getAction()->do($this->getCurrentRequest());
        $this->assertEquals(
            $this->getCurrentRequest(),
            $this->getAction()->export()['currentRequest']
        );

    }

    public function testUndoReturnsFalseIfCalledBeforeDo(): void
    {
        $this->assertFalse($this->getAction()->undo());
    }

    public function testCurrentRequestPropertyIsNotSetAfterCallToUndo(): void
    {
        $this->getAction()->do($this->getCurrentRequest());
        $this->getAction()->undo();
        $this->assertFalse(isset($this->getAction()->export()['currentRequest']));
    }

    // testCurrentRequestPropertyIsNotSetAfterCallToUndo()

    protected function setActionParentTestInstances(): void
    {
        $this->setOutputComponent($this->getAction());
        $this->setOutputComponentParentTestInstances();
    }

}
