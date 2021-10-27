<?php

namespace roady\interfaces\component;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

/**
 * A SwitchableComponent is a Component that has a switchable boolean state.
 */
interface SwitchableComponent extends SwitchableInterface, ComponentInterface
{

}
