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

}
