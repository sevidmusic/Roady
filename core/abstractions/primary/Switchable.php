<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Switchable as SwitchableInterface;

abstract class Switchable implements SwitchableInterface  {

    private $state = false;

    public function getState():bool {
        return $this->state;
    }

    public function switchState():bool {
        $initialState = $this->getState();
        $this->state = ($this->state === true ? false : true);
        return ($this->getState() !== $initialState);
    }

}
