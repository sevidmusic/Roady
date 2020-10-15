<?php

namespace DarlingDataManagementSystem\interfaces\component\Template\UserInterface;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;

interface StandardUITemplate extends SwitchableComponentInterface, PositionableInterface
{
    public function addType(OutputComponentInterface $outputComponent): void;

    public function removeType(string $type): void;

    public function getTypes(): array;
}
