<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\interfaces\component\OutputComponent as OutputComponentInterface;

abstract class OutputComponent extends SwitchableComponent implements OutputComponentInterface
{

    private $output = '';
    private $position = 0;


    public function getOutput(): string
    {
        return ($this->getState() === false ? '' : $this->output);
    }

    public function increasePosition(): bool
    {
        $initialPosition = $this->getPosition();
        $this->position++;
        return $initialPosition < $this->getPosition();
    }

    public function getPosition(): float
    {
        return ($this->position === 0) ? 0.0 : $this->position / 100;
    }

    public function decreasePosition(): bool
    {
        $initialPosition = $this->getPosition();
        $this->position--;
        return $initialPosition > $this->getPosition();
    }

}
