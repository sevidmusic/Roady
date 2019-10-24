<?php

namespace DarlingCms\interfaces\aggregate;

use DarlingCms\interfaces\primary\Classifiable;
use DarlingCms\interfaces\primary\Identifiable;

/**
 * Interface Component. Defines the basic contract of a
 * component, i.e., something with a name, a unique id,
 * and a type.
 * @package DarlingCms\interfaces\aggregate
 * @see Component::getName()
 * @see Component::getUniqueId()
 * @see Component::getType()
 */
interface Component extends Identifiable, Classifiable
{

}
