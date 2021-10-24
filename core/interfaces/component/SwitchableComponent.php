<?php

namespace roady\interfaces\component;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

/**
 * This interface defines an implementation of the Component interface
 * that has a boolean state.
 */
interface SwitchableComponent extends SwitchableInterface, ComponentInterface
{

}
