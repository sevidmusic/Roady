<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\interfaces\component\Action as ActionInterface;

abstract class Action extends CoreOutputComponent implements ActionInterface
{

    private $isDone = false;
    private $wasUndone = false;
    private $currentRequest;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
        $this->getCurrentRequest();
    }

    public function do(): bool
    {
        $this->isDone = true;
        $this->turnLoggingOn();
        $this->log("\nWarning: Use of Action type %s detected.\nThis type of Action does not do anything meaningful, it is meant to be used as a base that other Actions extend from.\n\nIf this Action is being used in development than this warning can be ignored.\n\nIt is recommended that you do not use this Action type in production, just for testing and development.\n\nAction Instance Info:\n\n    Action Name: %s\n    Action ID: %s\n    Action Location: %s\n    Action Container: %s\n\n    (Time of Use: %s)\n\n    Method Call: Action()->do()\n", $this->getType(), $this->getName(), $this->getUniqueId(), $this->getLocation(), $this->getContainer(), time());
        return true;
    }

    public function undo(): bool
    {
        if ($this->wasDone() === false) {
            return false;
        }
        $this->wasUndone = true;
        $this->turnLoggingOn();
        $this->log("\nWarning: Use of Action type %s detected.\nThis type of Action does not do anything meaningful, it is meant to be used as a base that other Actions extend from.\n\nIf this Action is being used in development than this warning can be ignored.\n\nIt is recommended that you do not use this Action type in production, just for testing and development.\n\nAction Instance Info:\n\n    Action Name: %s\n    Action ID: %s\n    Action Location: %s\n    Action Container: %s\n\n    (Time of Use: %s)\n\n    Method Call: Action()->undo()\n", $this->getType(), $this->getName(), $this->getUniqueId(), $this->getLocation(), $this->getContainer(), time());
        return true;
    }

    public function wasDone(): bool
    {
        return $this->isDone;
    }

    public function wasUndone(): bool
    {
        return $this->wasUndone;
    }

    protected function getCurrentRequest(): Request
    {
        if(isset($this->currentRequest) === false) {
            $currentRequest = new \DarlingCms\classes\component\Web\Routing\Request(
                new \DarlingCms\classes\primary\Storable(
                    'CurrentRequest',
                    'Temp',
                    'TemporaryRequests'
                ),
                new \DarlingCms\classes\primary\Switchable()
            );
            $this->currentRequest = $currentRequest;
        }
        return $this->currentRequest;
    }
    public function getOutput(): string
    {
        $this->do();
        return parent::getOutput();
    }

}
