<?php

namespace roady\abstractions\component;

use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

abstract class OutputComponent extends SwitchableComponent implements OutputComponentInterface
{

    private string $output = '';
    private PositionableInterface $positionable;


    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable)
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
