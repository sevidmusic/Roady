<?php

namespace DarlingDataManagementSystem\abstractions\component;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class OutputComponent extends SwitchableComponent implements OutputComponentInterface
{

    private $output = '';
    private $positionable;


    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable);
        $this->positionable = $positionable;
    }

    public function getOutput(): string
    {
        return ($this->getState() === false ? '' : $this->output);
    }

    public function increasePosition(): bool
    {
        if ($this->getState() === false) {
            return false;
        }
        return $this->positionable->increasePosition();
    }

    public function getPosition(): float
    {
        return $this->positionable->getPosition();
    }

    public function decreasePosition(): bool
    {
        if ($this->getState() === false) {
            return false;
        }
        return $this->positionable->decreasePosition();
    }

}
