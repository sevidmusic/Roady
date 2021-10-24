<?php

namespace roady\interfaces\component;

use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;

/**
 * This interface defines an object that has output, has
 * a numeric position, and has a boolean state.
 */
interface OutputComponent extends SwitchableComponentInterface, PositionableInterface
{

    /**
     * @return string The output.
     */
    public function getOutput(): string;

}
