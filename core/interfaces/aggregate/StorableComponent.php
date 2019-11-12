<?php

namespace DarlingCms\interfaces\aggregate;

use DarlingCms\interfaces\primary\Storable;

/**
 * Interface StorableComponent. Defines the basic contract of component
 * that is storable, i.e., a component that can be stored in a "container"
 * at a specified "location".
 * @package DarlingCms\interfaces\aggregate
 * @see StorableComponent::getName()
 * @see StorableComponent::getUniqueId()
 * @see StorableComponent::getType()
 * @see StorableComponent::getExpectedConstructorArgumentNames()
 * @see StorableComponent::getExpectedConstructorArgumentTypes()
 * @see StorableComponent::getExpectedConstructorArgumentDefaults()
 * @see StorableComponent::getLocation()
 * @see StorableComponent::getContainer()
 */
interface StorableComponent extends Component, Storable
{

}
