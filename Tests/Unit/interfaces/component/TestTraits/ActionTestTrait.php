<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Action as ActionInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as CoreRequestInterface;

trait ActionTestTrait
{

    private ActionInterface $action;
    private RequestInterface $currentRequest;

    public function testGetCurrentRequestReturnsRequestImplementationInstanceThatReflectsCurrentRequest(): void
    {
        $this->assertEquals(
            $this->getCurrentRequest()->getUrl(),
            $this->getAction()->getCurrentRequest()->getUrl()
        );

        $this->assertEquals(
            $this->getCurrentRequest()->getGet(),
            $this->getAction()->getCurrentRequest()->getGet()
        );

        $this->assertEquals(
            $this->getCurrentRequest()->getPost(),
            $this->getAction()->getCurrentRequest()->getPost()
        );
    }

    protected function getCurrentRequest(): CoreRequestInterface
    {
        if (isset($this->currentRequest) === false) {
            $currentRequest = new CoreRequest(
                new CoreStorable(
                    "CurrentRequest",
                    'CurrentRequestLocation',
                    'CurrentRequestContainer'
                ),
                new CoreSwitchable()
            );
            $this->currentRequest = $currentRequest;
        }
        return $this->currentRequest;
    }

    public function getAction(): ActionInterface
    {
        return $this->action;
    }

    public function setAction(ActionInterface $action): void
    {
        $this->action = $action;
    }

    public function testDoReturnsTrue(): void
    {
        $this->assertTrue($this->getAction()->do());
    }

    public function testUndoReturnsFalseWhenCalledBeforeDo(): void
    {
        $this->assertFalse($this->getAction()->undo());
        $this->getAction()->do();
    }

    public function testUndoReturnsTrueWhenCalledAfterDo(): void
    {
        $this->getAction()->do();
        $this->assertTrue($this->getAction()->undo());
    }

    public function testWasDoneReturnsFalseWhenCalledBeforeDo(): void
    {
        $this->assertFalse($this->getAction()->wasDone());
        $this->getAction()->do();
    }

    public function testWasDoneReturnsTrueWhenCalledAfterDo(): void
    {
        $this->getAction()->do();
        $this->assertTrue($this->getAction()->wasDone());
    }

    public function testWasDoneReturnsTrueWhenCalledAfterGetOutput(): void
    {
        $this->getAction()->getOutput();
        $this->assertTrue($this->getAction()->wasDone());
    }

    public function testWasUndoneReturnsTrueWhenCalledAfterUndo(): void
    {
        $this->getAction()->do();
        $this->getAction()->undo();
        $this->assertTrue($this->getAction()->wasUndone());
    }

    public function testWasUndoneReturnsFalseWhenCalledBeforeUndo(): void
    {
        $this->getAction()->do();
        $this->assertFalse($this->getAction()->wasUndone());
        $this->getAction()->undo();
    }

    public function testWasUndoneReturnsFalseWhenCalledBeforeDo(): void
    {
        $this->getAction()->undo();
        $this->assertFalse($this->getAction()->wasUndone());
        $this->getAction()->do();
    }

    protected function setActionParentTestInstances(): void
    {
        $this->setOutputComponent($this->getAction());
        $this->setOutputComponentParentTestInstances();
    }

}
