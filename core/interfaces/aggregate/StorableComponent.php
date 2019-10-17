<?php

namespace DarlingCms\interfaces\aggregate;

use DarlingCms\interfaces\primary\Storable;

/**
 * Interface StorableComponent. Defines the basic contract of a
 * a component that can be stored in a "container" at a "location".
 * @package DarlingCms\interfaces\aggregate
 */
interface StorableComponent extends Component, Storable
{

}
