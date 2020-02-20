<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

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
