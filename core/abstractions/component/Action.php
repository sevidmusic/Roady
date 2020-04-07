<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\interfaces\component\Action as ActionInterface;

abstract class Action extends CoreOutputComponent implements ActionInterface
{

    private $isDone = false;
    private $wasUndone = false;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }

    public function do(): bool
    {
        $this->isDone = true;
        return false;
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function undo(): bool
    {
        $this->wasUndone = true;
        return false;
    }

    public function wasUndone():bool
    {
        return $this->wasUndone;
    }

}
