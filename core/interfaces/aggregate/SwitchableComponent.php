<?php

namespace DarlingCms\interfaces\aggregate;

use DarlingCms\interfaces\primary\Switchable;

/**
 * Interface SwitchableComponent. Describes the basic contract of a
 * component that is switchable, i.e., a component that can be turned
 * on or off.
 * @package DarlingCms\interfaces\aggregate
 * @see SwitchableComponent::getName()
 * @see SwitchableComponent::getUniqueId()
 * @see SwitchableComponent::getType()
 * @see SwitchableComponent::getLocation()
 * @see SwitchableComponent::getContainer()
 * @see SwitchableComponent::getState()
 * @see SwitchableComponent::switchState()
 */
interface SwitchableComponent extends StorableComponent, Switchable
{

}
