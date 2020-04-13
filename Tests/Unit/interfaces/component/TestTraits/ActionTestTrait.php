<?php

namespace UnitTests\interfaces\component\TestTraits;

use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\component\Action;
use DarlingCms\interfaces\component\Web\Routing\Request as CoreRequestInterface;
use DarlingCms\classes\component\Web\Routing\Request;

trait ActionTestTrait
{

    private $action;
    private $currentRequest;

    public function getAction(): Action
    {
        return $this->action;
    }

    public function setAction(Action $action): void
    {
        $this->action = $action;
    }

    protected function setActionParentTestInstances(): void
    {
        $this->setOutputComponent($this->getAction());
        $this->setOutputComponentParentTestInstances();
    }

    protected function getCurrentRequest(): CoreRequestInterface
    {
        if (isset($this->currentRequest) === false) {
            $currentRequest = new Request(
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

    public function testGetCurrentRequestReturnsRequestImplenationInstanceThatReflectsCurrentRequest(): void
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

    public function testDoReturnsTrue(): void
    {
        $this->assertTrue($this->getAction()->do());
    }

    public function testUndoReturnsFalseWhenCalledBeforeDo(): void
    {
        $this->assertFalse($this->getAction()->undo());
    }

    public function testWasDoneReturnsFalseWhenCalledBeforeDo(): void
    {
        $this->assertFalse($this->getAction()->wasDone());
    }

    public function testUndoReturnsTrueWhenCalledAfterDo(): void
    {
        $this->getAction()->do();
        $this->assertTrue($this->getAction()->undo());
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

    public function testWasUndoneReturnsTrueWhenCalledAfterUndo():void
    {
        $this->getAction()->do();
        $this->getAction()->undo();
        $this->assertTrue($this->getAction()->wasUndone());
    }

    public function  testWasUndoneReturnsFalseWhenCalledBeforeUndo(): void
    {
        $this->getAction()->do();
        $this->assertFalse($this->getAction()->wasUndone());
    }

}
