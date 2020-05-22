<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\primary\Switchable as CoreSwitchableInterface;
use DarlingCms\interfaces\component\Action as ActionInterface;
use DarlingCms\interfaces\component\Web\Routing\Request as CoreRequestInterface;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable as CoreStorableInterface;

abstract class Action extends CoreOutputComponent implements ActionInterface
{
    private $currentRequest;
    private $wasDone = false;
    private $wasUndone = false;

    public function __construct(CoreStorableInterface $storable, CoreSwitchableInterface $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }


    public function getCurrentRequest(): CoreRequestInterface
    {
        if (isset($this->currentRequest) === false) {
            $this->currentRequest = new Request(
                new Storable(
                    'CurrentRequest',
                    'CurrentRequestLocation',
                    'CurrentRequestContainer'
                ),
                new Switchable()
            );
        }
        return $this->currentRequest;
    }

    public function undo(): bool
    {
        if ($this->wasDone() === false) {
            return false;
        }
        $this->wasUndone = true;
        return true;
    }

    public function wasDone(): bool
    {
        return $this->wasDone;
    }

    public function wasUndone(): bool
    {
        return $this->wasUndone;
    }

    public function getOutput(): string
    {
        $this->do();
        return parent::getOutput();
    }

    public function do(): bool
    {
        $this->wasDone = true;
        return true;
    }

}
