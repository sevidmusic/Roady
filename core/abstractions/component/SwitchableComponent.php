<?php

namespace DarlingDataManagementSystem\abstractions\component;

use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class SwitchableComponent extends Component implements SwitchableComponentInterface
{

    private $switchable;

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable);
        $this->setSwitchable($switchable);
        if ($this->getState() === false) {
            $this->switchState();
        }
    }

    private function setSwitchable(Switchable $switchable)
    {
        $this->switchable = $switchable;
    }

    public function getState(): bool
    {
        return $this->getSwitchable()->getState();
    }

    private function getSwitchable(): Switchable
    {
        return $this->switchable;
    }

    public function switchState(): bool
    {
        return $this->getSwitchable()->switchState();
    }

}