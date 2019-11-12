<?php

namespace DarlingCms\interfaces\aggregate;

use DarlingCms\interfaces\primary\Identifiable;
use DarlingCms\interfaces\primary\Classifiable;
use DarlingCms\interfaces\primary\Constructable;

/**
 * Interface Component. Defines the basic contract of a
 * something that can be identified, classified, and
 * constructed.
 *
 * @package DarlingCms\interfaces\aggregate
 * @see Component::getName()
 * @see Component::getUniqueId()
 * @see Component::getType()
 * @see Component::getExpectedConstructorArgumentNames()
 * @see Component::getExpectedConstructorArgumentTypes()
 * @see Component::getExpectedConstructorArgumentDefaults()
 */
interface Component extends Identifiable, Classifiable, Constructable
{

}
