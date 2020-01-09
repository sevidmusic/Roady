<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Switchable as SwitchableInterface;

abstract class Switchable implements SwitchableInterface
{

    private $state = false;

    public function switchState(): bool
    {
        $initialState = $this->getState();
        $this->state = ($this->state === true ? false : true);
        return ($this->getState() !== $initialState);
    }

    public function getState(): bool
    {
        return $this->state;
    }

}
