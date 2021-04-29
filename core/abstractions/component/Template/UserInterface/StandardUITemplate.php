<?php

namespace DarlingDataManagementSystem\abstractions\component\Template\UserInterface;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

abstract class StandardUITemplate extends SwitchableComponentBase implements StandardUITemplateInterface
{

    /**
     * @var array<string, string> $types
     */
    private array $types = [];
    private PositionableInterface $positionable;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable)
    {
        parent::__construct($storable, $switchable);
        $this->positionable = $positionable;
    }


    public function addType(OutputComponentInterface $outputComponent): void
    {
        while (isset($this->types[strval($outputComponent->getPosition())]) === true) {
            $outputComponent->increasePosition();
        }
        $this->types[strval($outputComponent->getPosition())] = $outputComponent->getType();
    }

    public function removeType(string $type): void
    {
        foreach ($this->types as $position => $assignedType) {
            if ($assignedType === $type) {
                unset($this->types[$position]);
            }
        }
    }

    /**
     * @return array<string, string>
     */
    public function getTypes(): array
    {
        return ($this->getState() === false ? [] : $this->types);
    }

    public function increasePosition(): bool
    {
        return $this->positionable->increasePosition();
    }

    public function decreasePosition(): bool
    {
        return $this->positionable->decreasePosition();
    }

    public function getPosition(): float
    {
        return $this->positionable->getPosition();
    }

}
