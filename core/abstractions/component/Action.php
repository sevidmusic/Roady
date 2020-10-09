<?php

namespace DarlingDataManagementSystem\abstractions\component;

use DarlingDataManagementSystem\abstractions\component\OutputComponent as OutputComponentBase;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\interfaces\component\Action as ActionInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;


abstract class Action extends OutputComponentBase implements ActionInterface
{
    private ?RequestInterface $currentRequest = null;
    private bool $wasDone = false;
    private bool $wasUndone = false;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }


    public function getCurrentRequest(): RequestInterface
    {
        if (isset($this->currentRequest) === false) {
            $this->currentRequest = new CoreRequest(
                new CoreStorable(
                    'CurrentRequest',
                    'CurrentRequestLocation',
                    'CurrentRequestContainer'
                ),
                new CoreSwitchable()
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
