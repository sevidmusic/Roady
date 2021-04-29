<?php

namespace DarlingDataManagementSystem\abstractions\component;

use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

abstract class SwitchableComponent extends Component implements SwitchableComponentInterface
{

    private SwitchableInterface $switchable;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable)
    {
        parent::__construct($storable);
        $this->setSwitchable($switchable);
        if ($this->getState() === false) {
            $this->switchState();
        }
    }

    private function setSwitchable(SwitchableInterface $switchable): void
    {
        $this->switchable = $switchable;
    }

    public function getState(): bool
    {
        return $this->getSwitchable()->getState();
    }

    private function getSwitchable(): SwitchableInterface
    {
        return $this->switchable;
    }

    public function switchState(): bool
    {
        return $this->getSwitchable()->switchState();
    }

}
